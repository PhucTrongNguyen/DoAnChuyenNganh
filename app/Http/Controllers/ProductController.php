<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Lấy các sản phẩm
        $featuredProducts = Product::where('quantity', '>', 0)->take(10)->get(); // Sản phẩm nổi bật
        $bestSaleProducts = Product::where('quantity', '>', 0)->orderBy('price', 'asc')->take(10)->get(); // Sản phẩm bán chạy
        $bestRatedProducts = Product::where('quantity', '>', 0)->orderBy('price', 'desc')->take(10)->get(); // Sản phẩm đánh giá cao
        $hotNewArrivals = Product::where('quantity', '>', 0)->orderBy('created_at', 'desc')->take(10)->get(); // Sản phẩm mới

        // Truyền dữ liệu đến view
        return view('products.index', compact('featuredProducts', 'bestSaleProducts', 'bestRatedProducts', 'hotNewArrivals'));
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // Sử dụng cột `name` để tìm kiếm
        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')
            ->whereNull('deleted_at')
            ->get();

        return view('products.search_results', compact('products')); // Gọi view tìm kiếm
    }
}
