<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\DiscountModel;
use App\Models\ProductImageModel;
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
    protected $productImageModel;

    function __construct()
    {
        $this->session = Services::session();

        $this->userModel = new UserModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->discountModel = new DiscountModel();
        $this->productImageModel = new ProductImageModel();
    }

    function checkSession()
    {
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

    public function create()
    {
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

    public function view()
    {
        $userSession = $this->checkSession();
        if ($userSession) {

            $categoryModel = new CategoryModel();
            $discountModel = new DiscountModel();
            $imageProductModel = new ProductImageModel();



            // Get data 
            $product = new ProductModel();
            $products = $product->findAll();

            // Membangun struktur data yang diinginkan
            $resultData = [];

            foreach ($products as $productItem) {
                $resultItem = [
                    'data_product' => $productItem,
                    'images' => $imageProductModel->where('product_id', $productItem['id'])->findAll()
                ];

                $resultData[] = $resultItem;
            }
            $data = [
                'title' => 'Product',
                'categories' => $categoryModel->findAll(),
                'products' => $resultData,
            ];

            echo view("admin/layout/header", $data);
            echo view("admin/layout/sidebar");
            echo view("admin/product/viewProduct", $data);
            echo view("admin/layout/footer");
        } else {
            $this->session->setFlashdata("error", "Maaf, Anda belum login");
            return redirect()->to("/login");
        }
    }


    public function save()
    {
        $rules = [
            "name" => "required",
            "stock" => "required",
            "price" => "required",
            "product_image" => "uploaded[product_image]|is_image[product_image]|mime_in[product_image,image/jpg,image/jpeg,image/png,image/webp]"
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
                    $products_images = $this->request->getFiles("product_image");

                    $uploaded_files = [];

                    foreach ($products_images['product_image'] as $product_image) {
                        $FILENAME = "img_" . hash("sha1", base64_encode(random_bytes(random_int(4, 50)))) . "." . $product_image->getExtension();
                        $product_image->move("uploads", $FILENAME);
                        $uploaded_files[] = base_url("uploads/" . $FILENAME);
                    }

                    $data_post = [
                        "userid" => $userSession['id'],
                        "product_name" => $product_name,
                        "product_category" => $product_category,
                        "product_price" => $product_price,
                        "product_stock"  => $product_stock,
                        "product_description" => $product_description,
                    ];

                    $this->productModel->save($data_post);
                    $id = $this->productModel->getInsertID();

                    $data_images = [];
                    foreach ($uploaded_files as $uploaded_file) {
                        $data_image = [
                            "product_id" => $id,
                            "image" => $uploaded_file
                        ];
                        $data_images[] = $data_image;
                    }

                    $this->productImageModel->insertBatch($data_images);

                    $this->session->setFlashdata("success", "Data berhasil ditambahkan");
                    return redirect()->to("/admin/product/create");
                } else {
                    $this->session->setFlashdata("errors", $this->validator->getErrors());
                    return redirect()->to("/admin/product/create");
                }
            } else {
                return redirect()->to("/admin/product/create");
            }
        }
    }

    public function update($id)
    {
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
        $imageProductModel = new ProductImageModel();

        $product = $productModel->find($id);
        $categories = $categoryModel->findAll();
        $productImages = $imageProductModel->where('product_id', $id)->findAll();

        if (!$product) {

            $this->session->setFlashdata("error", "Maaf produk tidak ditemukan");
            return redirect()->to("/admin/product/view");
        }

        $data = [
            'title' => 'Edit Produk',
            'product_id' => $id,
            'product' => $product,
            'categories' => $categories,
            'productImages' => $productImages,
        ];

        echo view("admin/layout/header", $data);
        echo view("admin/layout/sidebar");
        echo view('admin/product/updateProduct', $data);
        echo view("admin/layout/footer");
    }
    public function saveUpdate()
    {
        $productModel = new ProductModel();
        $imageProductModel = new ProductImageModel();

        $productId = $this->request->getPost('product_id');
        $product = $productModel->find($productId);

        if (!$product) {
            $this->session->setFlashdata("error", "Maaf produk tidak ditemukan");
            return redirect()->to("/admin/product/view");
        }

        // Update gambar-gambar
        $productImages = $this->request->getFiles('product_image')['product_image'];
        $imageIds = $this->request->getPost('image_ids');

        foreach ($productImages as $key => $productImage) {
            // Periksa apakah $productImage adalah instans dari UploadedFile
            if ($productImage instanceof \CodeIgniter\HTTP\Files\UploadedFile) {
                // Periksa apakah file valid dan tidak ada error
                if ($productImage->isValid() && !$productImage->hasMoved()) {
                    $filename = 'img_' . hash("sha1", base64_encode(random_bytes(random_int(4, 50)))) . '.' . $productImage->getExtension();
                    $productImage->move('uploads', $filename);

                    // Dapatkan ID gambar dari input hidden
                    $imageId = $imageIds[$key];

                    // Perbarui data gambar di tabel product_images
                    $imageData = [
                        'product_id' => $productId,
                        'image' => base_url("uploads/" . $filename),
                    ];

                    $imageProductModel->update($imageId, $imageData);
                }
            }
        }

        // Update informasi produk
        $productData = [
            'product_name' => $this->request->getPost('name'),
            'product_category' => $this->request->getPost('category'),
            'product_stock' => $this->request->getPost('stock'),
            'product_price' => $this->request->getPost('price'),
            'product_description' => $this->request->getPost('description'),
        ];

        $productModel->update($productId, $productData);

        $this->session->setFlashdata("success", "Data berhasil di edit");
        return redirect()->to("/admin/product/view");
    }


    public function delete()
    {
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
