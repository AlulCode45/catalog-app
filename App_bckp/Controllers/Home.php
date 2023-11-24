<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\DiscountModel;

class Home extends BaseController
{
    protected $context = array();

    public function index()
    {
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();

        $this->context["title"] = "Toko Bunga";
        $this->context["products"] = $productModel->findAll(6);
        $this->context["categories"] = $categoryModel->findAll();
        $this->context['discountModel'] = new DiscountModel();

        echo view("indexPage", $this->context);
    }
    public function product($id)
    {
        // $categoryModel = new CategoryModel();
        // $discountModel = new DiscountModel();
        // $request = service('request');
        // $searchData = $request->getGet();
        // $search = "";
        // if (isset($searchData) && isset($searchData['search'])) {
        //     $search = $searchData['search'];
        // }
        // // Get data 
        // $product = new ProductModel();
        // if ($search == '') {
        //     $paginateData = $product->paginate(6,'page');
        // } else {
        //     $paginateData = $product->select('*')
        //         ->orLike('product_name', $search)
        //         ->orLike('product_price', $search)
        //         ->orLike('product_description', $search)
        //         ->paginate(6, 'page');
        // }
        // $data = [
        //         'title' => 'Product',
        //         'discountModel' => $discountModel,
        //         'categories' => $categoryModel->findAll(),
        //         'products' => $paginateData,
        //         'pager' => $product->pager,
        //         'search' => $search
        //     ];

        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
        $discountModel = new DiscountModel();
        $data = [
            'product_id' => $id,
            'product' => $productModel->find($id),
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
