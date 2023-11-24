<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\DiscountModel;
use App\Models\ProductImageModel;

class Home extends BaseController
{
    protected $context = array();

    public function index()
    {
        $categoryModel = new CategoryModel();
        $discountModel = new DiscountModel();
        $imageProductModel = new ProductImageModel();

        $request = service('request');
        $searchData = $request->getGet();
        $search = "";
        $category = "";

        if (isset($searchData) && isset($searchData['search'])) {
            $search = $searchData['search'];
        }

        if (isset($searchData) && isset($searchData['category'])) {
            $category = $searchData['category'];
        }

        // Get data 
        $product = new ProductModel();

        if ($search != '') {
            $product->groupStart()
                ->like('product_name', $search)
                ->orLike('product_price', $search)
                ->orLike('product_description', $search)
                ->groupEnd();
        }

        if ($category != '') {
            $product->where('product_category', $category);
        }

        $paginateData = $product->paginate(4, 'page');

        // Membangun struktur data yang diinginkan
        $resultData = [];

        foreach ($paginateData as $productItem) {
            $resultItem = [
                'data_product' => $productItem,
                'images' => $imageProductModel->where('product_id', $productItem['id'])->findAll()
            ];

            $resultData[] = $resultItem;
        }
        $data = [
            'title' => 'Product',
            'discountModel' => $discountModel,
            'categories' => $categoryModel->findAll(),
            'products' => $resultData,
            'pager' => $product->pager,
            'search' => $search,
            'categoryActive' => $category
        ];


        echo view("indexPage", $data);
    }
    public function product($id)
    {
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
        $discountModel = new DiscountModel();
        $imageProductModel = new ProductImageModel();

        // Mengecek apakah produk dengan ID yang diberikan ada
        $product = $productModel->find($id);

        // if (!$product) {
        //     // Produk tidak ditemukan, dapatkan menangani kasus ini sesuai kebutuhan Anda
        //     return redirect()->to('/produk-tidak-ditemukan');
        // }

        // Mengambil gambar terkait dengan produk
        $productImages = $imageProductModel->where('product_id', $id)->findAll();

        // Jika produk ditemukan, lanjutkan dengan menyiapkan data
        $data = [
            'product_id' => $id,
            'product' => $product,
            'productImages' => $productImages,
            'categories' => $categoryModel->findAll(),
            'discountModel' => $discountModel
        ];

        return view('product/viewProduct', $data);
    }

    public function admin()
    {
        $this->context["title"] = "Dashboard";

        echo view("admin/layout/header", $this->context);
        echo view("admin/layout/sidebar");
        echo view("admin/dashboard");
        echo view("admin/layout/footer");
    }
}
