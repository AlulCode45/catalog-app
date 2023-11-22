<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\DiscountModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Config\Services;

class Products extends BaseController
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
            $this->context["title"] = "Create product";
            $this->context["categories"] = $this->categoryModel->findAll();
            $this->context["discounts"] = $this->discountModel->findAll();
            
            echo view("admin/layout/header", $this->context);
            echo view("admin/layout/sidebar");
            echo view("admin/product/createProduct", $this->context);
            echo view("admin/layout/footer");
        } else {
            $this->session->setFlashdata("error", "Maaf anda belum login");
            return redirect()->to("/login");
        }
    }

    public function view() {
        $userSession = $this->checkSession();
        if ($userSession) {
            $this->context["title"] = "View product";
            $this->context["categories"] = $this->categoryModel->findAll();
            $this->context["discounts"] = $this->discountModel->findAll();
            $this->context["products"] = $this->productModel->findAll();
            
            echo view("admin/layout/header", $this->context);
            echo view("admin/layout/sidebar");
            echo view("admin/product/viewProduct", $this->context);
            echo view("admin/layout/footer");
        } else {
            $this->session->setFlashdata("error", "Maaf anda belum login");
            return redirect()->to("/login");
        }
    }

    public function save() {
        $rules = [
            "name" => "required",
            "description" => "required",
            "stock" => "required",
            "price" => "required",
            "product_image" => "uploaded[product_image]"
                    . "|is_image[product_image]"
                    . "|mime_in[product_image,image/jpg,image/jpeg,image/png,image/webp]|max_size[product_image,1024]"
        ];

        $userSession = $this->checkSession();
        if ($userSession) {
            $method = strtolower($this->request->getMethod());
            if ($method == "post") {
                if ($this->validate($rules)) {
                    $product_name = $this->request->getVar('name');
                    $product_description = $this->request->getVar('description');
                    $product_stock = $this->request->getVar('stock');
                    $product_price = $this->request->getVar('price');
                    $product_category = $this->request->getVar('category');
                    $product_discount = $this->request->getVar('discount');
                    $product_image = $this->request->getFile("product_image");
    
                    if (!$product_image->hasMoved()) {
                        $FILENAME = "img_" . hash("sha1", base64_encode(random_bytes(random_int(4, 50)))) . "." . $product_image->getExtension();
                        $product_image->move("uploads", $FILENAME);
                        $data_post = [
                            "userid" => $userSession['id'],
                            "product_name" => $product_name,
                            "product_category" => $product_category,
                            "product_price" => $product_price,
                            "product_stock"  => $product_stock,
                            "product_discount" => $product_discount,
                            "product_description" => $product_description,
                            "product_image" => base_url("uploads/" . $FILENAME)
                        ];
        
                        $this->productModel->save($data_post);
                        $this->session->setFlashdata("success", "Data berhasil ditambahkan");
                        return redirect()->to("/admin/product/create");
                    } else {
                        $this->session->setFlashdata("error", "Gambar gagal diupload");
                        return redirect()->to("/admin/product/create");
                    }
                } else {
                    $this->session->setFlashdata("errors", $this->validator->getErrors());
                    return redirect()->to("/admin/product/create");
                }
            } else {
                return redirect()->to("/admin/product/create");
            }
        } else {
            $this->session->setFlashdata("error", "Maaf anda belum login");
            return redirect()->to("/login");
        }
    }

    public function update() {
        
    }

    public function delete() {
        $userSession = $this->checkSession(); 
        if ($userSession) {
            $method = strtolower($this->request->getMethod());
            if ($method == "post") {
                $productid = $this->request->getVar("productid");

                $productData = $this->productModel->where("id", $productid)->first();
                if ($productData) {
                    $this->productModel->delete($productData['id']);
                    $this->session->setFlashdata("success", "Data berhasil dihapus");
                    return redirect()->to("/admin/product/view");
                } else {
                    $this->session->setFlashdata("error", "Maaf produk tidak ditemukan");
                    return redirect()->to("/admin/product/view");
                }
            } else {
                return redirect()->to("/admin/product/view");
            }
        } else {
            $this->session->setFlashdata("error", "Maaf anda belum login");
            return redirect()->to("/login");
        }    
    }
}
