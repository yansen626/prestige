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


            //product image
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
            dd($ex);
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

    public function storeCustomize(Request $request)
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