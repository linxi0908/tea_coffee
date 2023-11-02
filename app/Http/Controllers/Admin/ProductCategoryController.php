<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
        $keyword = $request->keyword ?? '';
        $sortBy = $request->sortBy ?? 'latest';
        $status = $request->status ?? '';
        $sort = ($sortBy === 'oldest') ? 'asc' : 'desc';

        $filter = [];
        if(!empty($keyword)){
            $filter[] = ['name', 'like', '%'.$keyword.'%'];
        }

        if($status !== ''){
            $filter[] = ['status', $status];
        }

        $productCategories = ProductCategory::withTrashed()->where($filter)
        ->orderBy('created_at', $sort)
        ->paginate(10);

        return view('admin.pages.product_category.list',
            [
                'productCategories' => $productCategories,
                'keyword' => $keyword,
                'sortBy' => $sortBy,
                'status' => $status
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('admin.pages.product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $validatedData = $request->validated();

        if($request->hasFile('image')){
            $fileOrginialName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileOrginialName, PATHINFO_FILENAME);
            $fileName .= '_'.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images/product_categories'),  $fileName);
            $validatedData['image'] = $fileName;
        }


        $productCategories = ProductCategory::create($validatedData);
        $message = $productCategories ? 'Loại sản phẩm đã được thêm thành công.'  : 'Loại sản phẩm thêm thất bị';
        return redirect()->route('admin.product_category.index' )
        ->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productCategory = ProductCategory::find($id);

        return view('admin.pages.product_category.edit', ['productCategory'=>$productCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, $id)
    {
        $validatedData = $request->validated();
        $productCategory = ProductCategory::find($id);

        $oldImageFileName = $productCategory->image;

        if($request->hasFile('image')){
            $fileOrginialName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileOrginialName, PATHINFO_FILENAME);
            $fileName .= '_'.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images/product_categories'),  $fileName);
            $validatedData['image'] = $fileName;

            if(!is_null($oldImageFileName) && file_exists('images/product_categories/'.$oldImageFileName)){
                unlink('images/product_categories/'.$oldImageFileName);
            }

        }

        $productCategory->update($validatedData);


        $message = $productCategory ? 'Cập nhật sản phẩm thành công.' : 'Cập nhật sản phẩm thất bại.';
        //session flash
        return redirect()->route('admin.product_category.index')->with('message',$message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productCategories = ProductCategory::find($id);
        $image = $productCategories->image;
        if(!is_null($image) && file_exists('images/product_categories/'.$image)){
            unlink('images/product_categories/'.$image);
        }
        $result = ProductCategory::find($id)-> delete();
        $message = $result ? 'Xóa loại sản phẩm thành công.' : 'Xóa loại sản phẩm thất bại.';
        //session flash
        return redirect()->route('admin.product_category.index')->with('message',$message);
    }

    public function restore(string $id){
        $productCategory = ProductCategory::withTrashed()->find($id);
        $check = $productCategory->restore();

        $message = $check > 0 ? 'Khôi phục loại sản phẩm thành công.' : 'Khôi phục loại sản phẩm thất bại.';
        return redirect()->route('admin.product_category.index')->with('message',$message);
    }
    public function createSlug(Request $request){
        return response()->json(['slug' => Str::slug($request->name, '-')]);
    }
}
