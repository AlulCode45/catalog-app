<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\DiscountModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Config\Services;

class Category extends BaseController
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
            $this->context["title"] = "Create category";
            
            echo view("admin/layout/header", $this->context);
            echo view("admin/layout/sidebar");
            echo view("admin/category/createCategory", $this->context);
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
                $categoryName = $this->request->getVar("name");
                $categoryDescription = $this->request->getVar("description");

                if ($action == "new") {
                    $data_post = [
                        "category_name" => $categoryName,
                        "category_description" => $categoryDescription
                    ];

                    $this->categoryModel->save($data_post);

                    $this->session->setFlashdata("success", "Data berhasil ditambahkan");
                    return redirect()->to("admin/category/create");
                } else {
                    return redirect()->to("admin/category/create");
                }
            } else {
                return redirect()->to("admin/category/create");
            }
        } else {
            $this->session->setFlashdata("error", "Maaf anda belum login");
            return redirect()->to("/login");
        }
    }

    public function view() {
        $userSession = $this->checkSession();
        if ($userSession) {
            $this->context["title"] = "View category";
            $this->context["categories"] = $this->categoryModel->findAll();
            
            echo view("admin/layout/header", $this->context);
            echo view("admin/layout/sidebar");
            echo view("admin/category/viewCategory", $this->context);
            echo view("admin/layout/footer");
        } else {
            $this->session->setFlashdata("error", "Maaf anda belum login");
            return redirect()->to("/login");
        }
    }

    public function update() {
        
    }

    public function delete() {
        
    }
}
