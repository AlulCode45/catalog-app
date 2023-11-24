<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Config\Services;

class Users extends BaseController
{
    protected $session;
    protected $context = array();
    protected $helpers = [];
    protected $userModel;
    protected $productModel;
    protected $categoryModel;

    function __construct()
    {
        $this->session = Services::session();

        $this->userModel = new UserModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
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
        return redirect()->to("/login", 301);
    }

    public function login() {
        $method = strtolower($this->request->getMethod());

        if ($method == "post") {
            $username = $this->request->getVar("username");
            $password = $this->request->getVar("password");
            
            $userData = $this->userModel->where("username", $username)->first();
            if ($userData) {
                if (password_verify($password, $userData["password"])) {
                    $sesi = [
                        "login" => true,
                        "email" => $userData["email"]
                    ];

                    $this->session->set($sesi);
                    $this->session->setFlashdata("success", "Kamu berhasil login");
                    return redirect()->to("/admin");
                } else {
                    $this->session->setFlashdata("error", "Maaf password salah");
                    return redirect()->to("/login");
                }
            } else {
                $this->session->setFlashdata("error", "Maaf akun tidak ditemukan");
                return redirect()->to("/login");
            }
        } else {
            $userSession = $this->checkSession();
            if ($userSession) {
                $this->session->destroy();
            }
            echo view("admin/account/login", $this->context);
        }
    }

    public function update() {

    }

    public function delete() {

    }

    public function logout() {
        $userSession = $this->checkSession();

        if ($userSession) {
            $this->session->destroy();
            $this->session->setFlashdata("success", "Berhasil logout");
        } else {
            $this->session->setFlashdata("error", "Maaf kamu belum login");
        }
        return redirect()->to("/login");
    }
}
