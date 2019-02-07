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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
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
        $productPosition = ProductPosition::where('product_id', $item->id)->get();

        $data = [
            'product'    => $item,
            'productCategory'    => $productCategory,
            'productPosition'    => $productPosition,
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
            $colourNew = Utilities::CreateProductSlug($request->input('colour'));
            $is_primary = 1;
            $is_exist = Product::where('name', $request->input('name'))->first();
            if(!empty($is_exist)){
                $is_primary = 0;
            }
//            dd($colourNew);
            $newProduct = Product::create([
                'name' => $request->input('name'),
                'slug' => $slug."--".$colourNew,
                'sku' => $request->input('sku'),
                'category_id' => $request->input('category'),
                'description' => $request->input('description'),
                'style_notes' => $request->input('style_notes'),
                'qty' => $request->input('qty'),
                'price' => (double) $request->input('price'),
                'colour' => $colourNew,
                'weight' => $request->input('weight'),
                'width' => $request->input('width'),
                'height' => $request->input('height'),
                'length' => $request->input('length'),
                'tag' => $request->input('tags'),
                'is_primary' => $is_primary,
                'status' => 1,
                'created_at'        => $dateTimeNow->toDateTimeString(),
                'updated_at'        => $dateTimeNow->toDateTimeString()
            ]);

            // save product category
//                $newProductCategory = CategoryProduct::create([
//                    'category_id' => $request->input('category'),
//                    'product_id' => $newProduct->id,
//                    'created_at'        => $dateTimeNow->toDateTimeString(),
//                ]);

            // save product position
        $newProductCategory = ProductPosition::create([
            'product_id' => $newProduct->id,
            'name' => "Top Middle",
            'pos_x' => 250,
            'pos_y' => 300,
        ]);

            // save product main image, and image detail
            $img = Image::make($mainImages);
            $extStr = $img->mime();
            $ext = explode('/', $extStr, 2);

            $filename = $newProduct->id.'_main_'.$slug.'_'.Carbon::now('Asia/Jakarta')->format('Ymdhms'). '.'. $ext[1];

            if(env('SERVER_HOST_URL') == 'http://localhost:8000/'){
                $img->save(public_path('storage/products/'. $filename), 75);
            }
            else{
                $img->save('../public_html/storage/products/'. $filename, 75);
            }
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

                if(env('SERVER_HOST_URL') == 'http://localhost:8000/'){
                    $img->save(public_path('storage/products/'. $filename), 75);
                }
                else{
                    $img->save('../public_html/storage/products/'. $filename, 75);
                }

                $newProductImage = ProductImage::create([
                    'product_id' => $newProduct->id,
                    'path' => $filename,
                    'is_main_image' => 0
                ]);
            }
//                dd($newProductCategory);
            return redirect()->route('admin.product.edit.customize',['item' => $newProductCategory->id]);

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
//        dd($item);
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
            ]);

            return redirect()->route('admin.product.show',['item' => $item->id]);

        }catch(\Exception $ex){
            dd($ex);
            error_log($ex);
            return back()->withErrors("Something Went Wrong")->withInput();
        }
    }

    public function editCustomize(ProductPosition $item)
    {
        $mainImage = ProductImage::where('product_id', $item->product_id)->where('is_main_image', 1)->first();
        $data = [
            'productPosition'    => $item,
            'mainImage'    => $mainImage,
        ];
        return view('admin.product.edit-customize')->with($data);
    }

    public function updateCustomize(Request $request, ProductPosition $item)
    {
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
            $item->name = $request->input('position_name');
            $item->pos_x = $request->input('position_x');
            $item->pos_y = $request->input('position_y');
            $item->save();

            return redirect()->route('admin.product.show',['item' => $item->product_id]);

        }catch(\Exception $ex){
            dd($ex);
            error_log($ex);
            return back()->withErrors("Something Went Wrong")->withInput();
        }
    }

    public function edit(Product $item)
    {
        $categories = Category::all();
        $mainImage = ProductImage::where('product_id', $item->id)->where('is_main_image', 1)->first();
        $detailImage = ProductImage::where('product_id', $item->id)->where('is_main_image', 0)->get();
        $selectedCategory = CategoryProduct::where('product_id', $item->id)->first();
        $data = [
            'product'    => $item,
            'categories'    => $categories,
            'selectedCategory'    => $selectedCategory,
            'mainImage'    => $mainImage,
            'detailImage'    => $detailImage,
        ];
        return view('admin.product.edit')->with($data);
    }

    public function update(Request $request){
//        dd($request);
        try{
            $validator = Validator::make($request->all(), [
                'name'        => 'required',
                'sku'         => 'required',
                'category'             => 'required',
                'price'             => 'required',
                'qty'             => 'required',
                'weight'             => 'required',
                'description'             => 'required',
            ]);
            $product = Product::find($request->input('id'));
            if ($request->input('category') == "-1") {
                return back()->withErrors("Category is required")->withInput($request->all());
            }
//            dd($request);
            $detailImages = $request->file('detail_image');
            $mainImages = $request->file('main_image');

            if ($validator->fails())
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

            $dateTimeNow = Carbon::now('Asia/Jakarta');
            $slug = Utilities::CreateProductSlug($request->input('name'));

            $colourNew = Utilities::CreateProductSlug($request->input('colour'));

//            dd($slug);
            // update product
            $product->category_id = $request->input('category');
            $product->name = $request->input('name');
            $product->slug = $slug."--".$colourNew;
            $product->sku = $request->input('sku');
            $product->description = $request->input('description');
            $product->style_notes = $request->input('style_notes');
            $product->qty = $request->input('qty');
            $product->price = (double) $request->input('price');
            $product->weight = $request->input('weight');
            $product->width = $request->input('width');
            $product->height = $request->input('height');
            $product->length = $request->input('length');
            $product->tag = $request->input('tags');
            $product->updated_at = $dateTimeNow->toDateTimeString();

            $product->save();

//            // update product category
//            $selectedCategory = CategoryProduct::where('product_id', $product->id)->first();
//            $selectedCategory->category_id = $request->input('category');
//            $selectedCategory->updated_at = $dateTimeNow->toDateTimeString();
//            $selectedCategory->save();


            // update product main image, and image detail

            if(!empty($mainImages)){

                $mainImage = ProductImage::where('product_id', $product->id)->where('is_main_image', 1)->first();
                if(!empty($mainImage)){
                    $path = $mainImage->path;

                    $img = Image::make($mainImages);
                    if(env('SERVER_HOST_URL') == 'http://localhost:8000/'){
                        $img->save(public_path('storage/products/'. $path), 75);
                    }
                    else{
                        $img->save('../public_html/storage/products/'. $path, 75);
                    }
                }
                else{
                    $img = Image::make($mainImages);
                    $extStr = $img->mime();
                    $ext = explode('/', $extStr, 2);
                    $filename = $product->id.'_main_'.$slug.'_'.Carbon::now('Asia/Jakarta')->format('Ymdhms'). '.'. $ext[1];

                    if(env('SERVER_HOST_URL') == 'http://localhost:8000/'){
                        $img->save(public_path('storage/products/'. $filename), 75);
                    }
                    else{
                        $img->save('../public_html/storage/products/'. $filename, 75);
                    }
                    $newProductImage = ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $filename,
                        'is_main_image' => 1
                    ]);
                }


            }
            if(!empty($detailImages)){
                $detailImage = ProductImage::where('product_id', $product->id)->where('is_main_image', 0)->get();

                foreach($detailImage as $image){
                    $image->delete();
                }

                for($i=0;$i<sizeof($detailImages);$i++){
                    $img = Image::make($detailImages[$i]);
                    $extStr = $img->mime();
                    $ext = explode('/', $extStr, 2);

                    $filename = $product->id.'_'.$i.'_'.$slug.'_'.Carbon::now('Asia/Jakarta')->format('Ymdhms'). '.'. $ext[1];

                    if(env('SERVER_HOST_URL') == 'http://localhost:8000/'){
                        $img->save(public_path('storage/products/'. $filename), 75);
                    }
                    else{
                        $img->save('../public_html/storage/products/'. $filename, 75);
                    }

                    $newProductImage = ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $filename,
                        'is_main_image' => 0
                    ]);
                }
            }


            return redirect()->route('admin.product.show',['item' => $product->id]);

        }catch(\Exception $ex){
//            dd($ex);
            error_log($ex);
            return back()->withErrors("Something Went Wrong")->withInput();
        }
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        try {
            $product = Product::find($request->id);
            $product->status = 2;
            $product->save();

            Session::flash('success', 'Success Deleting ');
            return Response::json(array('success' => 'VALID'));
        }
        catch(\Exception $ex){
            return Response::json(array('errors' => 'INVALID'));
        }


    }
}