<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\DiscountModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Config\Services;

class Discount extends BaseController
{
    protected $session;
    protected $context = array();
    protected $helpers = [];
    protected $userModel;
    protected $productModel;
    protected $categoryModel;
    protected $discountModel;

    function __construct()
    {
        $this->session = Services::session();

        $this->userModel = new UserModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->discountModel = new DiscountModel();
    }

    function checkSession() {
        $isLogin = $this->session->get("login");
        if ($isLogin) {
            $email = $this->session->get("email");
            $userData = $this->userModel->where("email", $email)->first();
            if ($userData) {
                return $userData;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function index()
    {
        //
    }

    public function create() {
        $userSession = $this->checkSession();
        if ($userSession) {
            $this->context["title"] = "Create discount";
            
            echo view("admin/layout/header", $this->context);
            echo view("admin/layout/sidebar");
            echo view("admin/discount/createDiscount", $this->context);
            echo view("admin/layout/footer");
        } else {
            $this->session->setFlashdata("error", "Maaf anda belum login");
            return redirect()->to("/login");
        }
    }

    public function view() {
        $userSession = $this->checkSession();
        if ($userSession) {
            $this->context["title"] = "View discount";
            $this->context["discounts"] = $this->discountModel->findAll();
            
            echo view("admin/layout/header", $this->context);
            echo view("admin/layout/sidebar");
            echo view("admin/discount/viewDiscount", $this->context);
            echo view("admin/layout/footer");
        } else {
            $this->session->setFlashdata("error", "Maaf anda belum login");
            return redirect()->to("/login");
        }
    }

    public function save() {
        $userSession = $this->checkSession();
        if ($userSession) {
            $method = strtolower($this->request->getMethod());
            if ($method == "post") {
                $action = $this->request->getVar("action");
                $discountName = $this->request->getVar("name");
                $discountDescription = $this->request->getVar("description");
                $discountPercent = $this->request->getVar("percent");

                if (intval($discountPercent) > 100) {
                    $this->session->setFlashdata("error", "Maaf persentase tidak boleh melebihi 100%");
                    return redirect()->to("admin/discount/create");        
                } else {
                    if ($action == "new") {
                        $data_post = [
                            "discount_name" => $discountName,
                            "discount_description" => $discountDescription,
                            "discount_percent" => $discountPercent,
                            "discount_active" => 1
                        ];
    
                        $this->discountModel->save($data_post);
    
                        $this->session->setFlashdata("success", "Data berhasil ditambahkan");
                        return redirect()->to("admin/discount/create");
                    } else {
                        return redirect()->to("admin/discount/create");
                    }
                }
            } else {
                return redirect()->to("admin/discount/create");
            }
        } else {
            $this->session->setFlashdata("error", "Maaf anda belum login");
            return redirect()->to("/login");
        }
    }

    public function delete() {
        $userSession = $this->checkSession(); 
        if ($userSession) {
            $method = strtolower($this->request->getMethod());
            if ($method == "post") {
                $discountid = $this->request->getVar("discountid");
                
                $discountData = $this->discountModel->where("id", $discountid)->first();
                if ($discountData) {
                    $this->discountModel->delete($discountData['id']);
                    $this->session->setFlashdata("success", "Data berhasil dihapus");
                    return redirect()->to("/admin/discount/view");
                } else {
                    $this->session->setFlashdata("error", "Maaf diskon tidak ditemukan");
                    return redirect()->to("/admin/discount/view");
                }
            } else {
                return redirect()->to("/admin/discount/view");
            }
        } else {
            $this->session->setFlashdata("error", "Maaf anda belum login");
            return redirect()->to("/login");
        }
    }
}
