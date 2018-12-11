<?php
/**
 * Created by PhpStorm.
 * User: YANSEN
 * Date: 12/10/2018
 * Time: 10:06
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\libs\Utilities;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Transformer\ProductTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
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
        $categories = Category::all();

        $data = [
            'categories'    => $categories,
        ];
        return view('admin.product.create')->with($data);
    }

    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name'        => 'required',
                'sku'         => 'required',
                'category'             => 'required',
                'price'             => 'required',
                'qty'             => 'required',
                'weight'             => 'required',
                'product_detail'             => 'required',
                'tags'             => 'required',
            ]);

            if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

            $dateTimeNow = Carbon::now('Asia/Jakarta');
            $slug = Utilities::CreateProductSlug($request->input('name'));

//            dd($request);
            $newProduct = Product::create([
                'name' => $request->input('name'),
                'slug' => $slug,
                'sku' => $request->input('sku'),
                'description' => $request->input('description'),
                'qty' => $request->input('qty'),
                'price' => (double) $request->input('price'),
                'weight' => $request->input('weight'),
                'width' => $request->input('width'),
                'height' => $request->input('height'),
                'length' => $request->input('length'),
                'status_id' => 1,
                'created_at'        => $dateTimeNow->toDateTimeString(),
                'updated_at'        => $dateTimeNow->toDateTimeString()
            ]);

            $newProductCategory = CategoryProduct::create([
                'category_id' => $request->input('category'),
                'product_id' => $newProduct->id,
                'created_at'        => $dateTimeNow->toDateTimeString(),
            ]);

            return redirect()->route('admin.product.create.position',['item' => $newProduct->id]);

        }catch(\Exception $ex){
//            dd($ex);
            error_log($ex);
            return back()->withErrors("Something Went Wrong")->withInput();
        }
    }

    public function createPosition(Product $item)
    {
        $data = [
            'product'    => $item,
        ];
        return view('admin.product.create-position')->with($data);
    }

    public function storePosition(Request $request)
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