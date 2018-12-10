<?php
/**
 * Created by PhpStorm.
 * User: YANSEN
 * Date: 12/10/2018
 * Time: 10:06
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.product.index');
    }

    public function show(Product $item)
    {
        return view('admin.product.show');
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {

    }

    public function edit(Product $item)
    {
        return view('admin.product.edit');
    }
}