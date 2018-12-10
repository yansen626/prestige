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
use App\Transformer\ProductTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

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

    public function getIndex(Request $request){
        $users = Product::all();
        return DataTables::of($users)
            ->setTransformer(new ProductTransformer())
            ->addIndexColumn()
            ->make(true);
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
        dd($request);
        $img = Image::make(Input::get('img_data'));
        $extStr = $img->mime();
        $ext = explode('/', $extStr, 2);

        $filename = 'test_image.'. $ext[1];

        $img->save(public_path('storage/user_custom/'. $filename), 75);
        dd($img);
    }

    public function edit(Product $item)
    {

        return view('admin.product.edit');
    }
}