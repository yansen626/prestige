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
use App\Models\ProductImage;
use App\Models\ProductPosition;
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
        $images = ProductImage::where('product_id', $item->id)->orderby('is_main_image','desc')->get();
        $productCategory = CategoryProduct::where('product_id', $item->id)->first();
        $data = [
            'product'    => $item,
            'productCategory'    => $productCategory,
            'images'    => $images,
        ];
        return view('admin.product.show')->with($data);
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
                'description'             => 'required',
                'tags'             => 'required',
            ]);

            if ($request->input('category') == "-1") {
                return back()->withErrors("Category is required")->withInput($request->all());
            }
//            dd($request);
            $detailImages = $request->file('detail_image');
            $mainImages = $request->file('main_image');

            if($detailImages == null){
                return back()->withErrors("Detail Image required")->withInput($request->all());
            }
            if ($validator->fails())
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

            $dateTimeNow = Carbon::now('Asia/Jakarta');
            $slug = Utilities::CreateProductSlug($request->input('name'));

//            dd($slug);
            // save product
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
                'tag' => $request->input('tags'),
                'status_id' => 1,
                'created_at'        => $dateTimeNow->toDateTimeString(),
                'updated_at'        => $dateTimeNow->toDateTimeString()
            ]);

            // save product category
            $newProductCategory = CategoryProduct::create([
                'category_id' => $request->input('category'),
                'product_id' => $newProduct->id,
                'created_at'        => $dateTimeNow->toDateTimeString(),
            ]);


            // save product main image, and image detail
            $img = Image::make($mainImages);
            $extStr = $img->mime();
            $ext = explode('/', $extStr, 2);

            $filename = $newProduct->id.'_main_'.$slug.'_'.Carbon::now('Asia/Jakarta')->format('Ymdhms'). '.'. $ext[1];

            $img->save(public_path('storage/products/'. $filename), 75);
            $newProductImage = ProductImage::create([
                'product_id' => $newProduct->id,
                'path' => $filename,
                'is_main_image' => 1
            ]);
            for($i=0;$i<sizeof($detailImages);$i++){
                $img = Image::make($detailImages[$i]);
                $extStr = $img->mime();
                $ext = explode('/', $extStr, 2);

                $filename = $newProduct->id.'_'.$i.'_'.$slug.'_'.Carbon::now('Asia/Jakarta')->format('Ymdhms'). '.'. $ext[1];

                $img->save(public_path('storage/products/'. $filename), 75);

                $newProductImage = ProductImage::create([
                    'product_id' => $newProduct->id,
                    'path' => $filename,
                    'is_main_image' => 0
                ]);
            }

            return redirect()->route('admin.product.create.customize',['item' => $newProduct->id]);

        }catch(\Exception $ex){
//            dd($ex);
            error_log($ex);
            return back()->withErrors("Something Went Wrong")->withInput();
        }
    }

    public function createCustomize(Product $item)
    {
        $mainImage = ProductImage::where('product_id', $item->id)->where('is_main_image', 1)->first();
        $data = [
            'product'    => $item,
            'mainImage'    => $mainImage,
        ];
        return view('admin.product.create-customize')->with($data);
    }

    public function storeCustomize(Request $request, Product $item)
    {
        dd($request);
        try{
            $validator = Validator::make($request->all(), [
                'position_name'        => 'required',
                'position_x'         => 'required',
                'position_y'             => 'required',
            ]);
            if ($validator->fails())
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

            // save product position
            $dateTimeNow = Carbon::now('Asia/Jakarta');
            $newProductCustomize = ProductPosition::create([
                'product_id' => $item->id,
                'name' => $request->input('position_name'),
                'pos_x' => $request->input('position_x'),
                'pos_y' => $request->input('position_y'),
                'created_at'        => $dateTimeNow->toDateTimeString(),
                'updated_at'        => $dateTimeNow->toDateTimeString(),
            ]);

            return redirect()->route('admin.product.show',['item' => $item->id]);

        }catch(\Exception $ex){
//            dd($ex);
            error_log($ex);
            return back()->withErrors("Something Went Wrong")->withInput();
        }
    }

    public function editCustomize(Product $item)
    {
        $mainImage = ProductImage::where('product_id', $item->id)->where('is_main_image', 1)->first();
        $data = [
            'product'    => $item,
            'mainImage'    => $mainImage,
        ];
        return view('admin.product.create-customize')->with($data);
    }

    public function updateCustomize(Product $item)
    {
        $mainImage = ProductImage::where('product_id', $item->id)->where('is_main_image', 1)->first();
        $data = [
            'product'    => $item,
            'mainImage'    => $mainImage,
        ];
        return view('admin.product.create-customize')->with($data);
    }

    public function edit(Product $item)
    {

        return view('admin.product.edit');
    }


    public function getProducts(Request $request){
        $term = trim($request->q);
        $roles = Product::where('id', '!=', $request->id)
            ->where(function ($q) use ($term) {
                $q->where('name', 'LIKE', '%' . $term . '%');
            })
            ->get();

        $formatted_tags = [];

        foreach ($roles as $role) {
            $formatted_tags[] = ['id' => $role->id, 'text' => $role->name];
        }

        return \Response::json($formatted_tags);
    }
}