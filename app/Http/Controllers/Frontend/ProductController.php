<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * show product list and search result.
     *
     */
    public function index(){
        $category = request()->category;
        if(!empty($category)){
            $filter = $category;

            $items = Product::where('is_primary', 1)
                ->where('category_id', $filter)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        else{
            $items = Product::where('is_primary', 1)
                ->orderBy('created_at', 'desc')
                ->get();
            $filter = 0;
        }
//        dd($items);
        $data = [
            'productResult'      => $items,
            'filter'      => $filter
        ];
        return view('frontend.products.index')->with($data);
    }

    /**
     * show product detail.
     *
     */
    public function show($product){
        $slug = $product;
        if (strpos($product, '--') !== false) {
            $productArr = explode('--', $product);
            $slug = $productArr[0];
        }
        $productDB = Product::where('slug', $product)->first();
        $otherProductColour = Product::where('slug','like', '%'.$slug.'%')->get();

        $data = [
            'product'      => $productDB,
            'otherProductColour'      => $otherProductColour
        ];
//        dd($data);
        return view('frontend.products.show')->with($data);
    }

    /**
     * show product search result.
     *
     */
    public function search(Request $request){
//        $products = ProductImage::where('is_main_image', 1)
//            ->where(function ($query) {
//                $query->where('status_id', 8)
//                    ->orWhere('status_id', 9)
//                    ->orWhere('status_id', 10);
//            })
        $productResult = Product::where('name','like','%'.$request->input('search-text').'%')
            ->where('status', 1)
            ->get();
        $filter = -1;
        $data = [
            'productResult' => $productResult,
            'filter'        => $filter,
            'searchText'        => $request->input('search-text'),

        ];
        return view('frontend.products.index')->with($data);
    }
}
