<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Transformer\CategoryTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
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
        $users = Category::query();
        return DataTables::of($users)
            ->setTransformer(new CategoryTransformer)
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|max:100',
            'slug'  => 'required|max:100'
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

        $category = Category::create([
            'name'              => $request->input('name'),
            'slug'              => $request->input('slug'),
            'meta_title'        => $request->input('meta_title'),
            'meta_description'  => $request->input('meta_description'),
            'created_at'        => Carbon::now('Asia/Jakarta'),
            'updated_at'        => Carbon::now('Asia/Jakarta')
        ]);

        dd($request->input('parent'));

        if($request->input('parent') != null){
            //case if parent
            $category->parent_id = $request->input('category');
            $category->save();
        }

        Session::flash('success', 'Success Creating new Category!');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        if($category->parent_id != null && $category->parent_id != 0){
            $parent = Category::find($category->parent_id);
        }
        else{
            $parent = null;
        }

        return view('admin.category.edit', compact('category', 'parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|max:100',
            'slug'  => 'required|max:100'
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

        $category = Category::find($request->input('id'));
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->meta_title = $request->input('meta_title');
        $category->meta_description = $request->input('meta_description');
        $category->updated_at = Carbon::now('Asia/Jakarta');

        if($request->input('parent') != null){
            //case if parent
            $category->parent_id = $request->input('parent');
        }
        $category->save();

        Session::flash('success', 'Success Updating new Category!');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        try {
            //Belum melakukan pengecekan hubungan antar Table
            $categoryId = $request->input('id');
            $category = Category::find($categoryId);
            $category->delete();

            Session::flash('success', 'Success Deleting Category ' . $category->name . ' - ' . $category->slug);
            return Response::json(array('success' => 'VALID'));
        }
        catch(\Exception $ex){
            return Response::json(array('errors' => 'INVALID'));
        }
    }

    public function getCategories(Request $request){
        $term = trim($request->q);
        $roles = Category::where('id', '!=', $request->id)
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
