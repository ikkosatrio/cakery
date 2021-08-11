<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\ProductCategory;

class ProductController extends Controller
{
    public function __construct() {
        $this->data['category'] = ProductCategory::all();
    }
    public function detail($slug)
    {
        $data = $this->data;
        $data['menu'] = "Product";
        $data['title'] = "Product";
        $data['product'] = Product::GetBySlug($slug);
        $data['cart'] = \Cart::getContent();

        // dd($data['product']);
        $data['related_product'] = Product::GetRelated($data['product']);
        return view("user/product/detail",compact('data'));
    }
}
