<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword ?? '';
        $sortBy = $request->sortBy ?? 'latest';
        $status = $request->status ?? '';
        $featured = $request->featured ?? '';
        $sort = ($sortBy === 'oldest') ? 'asc' : 'desc';

        $filter = [];
        if(!empty($keyword)){
            $filter[] = ['products.name', 'like', '%'.$keyword.'%'];
        }

        if($status !== ''){
            $filter[] = ['status', $status];
        }

        if($featured !== ''){
            $filter[] = ['featured', $featured];
        }

        $products = Product::withTrashed()
        ->where($filter)
        ->orderBy('created_at', $sort)
        ->paginate(10);
        return view('admin.pages.product.list',
        [
            'products'=> $products,
            'keyword' => $keyword,
            'sortBy' => $sortBy,
            'status' => $status,
            'featured' => $featured,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = ProductCategory::get();
        return view('admin.pages.product.create',['productCategories' => $productCategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        if($request->hasFile('image')){
            $fileOrginialName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileOrginialName, PATHINFO_FILENAME);
            $fileName .= '_'.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images/products'),  $fileName);
            $validatedData['image'] = $fileName;
        }

        $product = Product::create($validatedData);

        $message = $product ? 'Thêm sản phẩm thành công.' : 'Thêm sản phẩm thất bại';
        return redirect()->route('admin.product.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('product_categories')->find($id);
        $productCategories = ProductCategory::all();
        return view('admin.pages.product.edit',
        ['product'=> $product, 'productCategories' => $productCategories]);
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
    public function update(UpdateProductRequest $request, string $id)
    {
        $validatedData = $request->validated();

        $product = Product::find($id);
        $oldImageFileName = $product->image;

        if($request->hasFile('image')){
            $fileOrginialName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileOrginialName, PATHINFO_FILENAME);
            $fileName .= '_'.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images/products'),  $fileName);
            $validatedData['image'] = $fileName;

            if(!is_null($oldImageFileName) && file_exists('images/products/'.$oldImageFileName)){
                unlink('images/products/'.$oldImageFileName);
            }

        }

        $product->update($validatedData);
        $message = $product ? 'Cập nhật sản phẩm thành công.' : 'Cập nhật sản phẩm thất bại.';
        return redirect()->route('admin.product.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $image = $product->image;
        if(!is_null($image) && file_exists('images/products/'.$image)){
            unlink('images/products/'.$image);
        }
        $result = Product::find($id)->delete();
        $message = $result ? 'Xóa sản phẩm thành công.' : 'Xóa sản phẩm thất bại';
        return redirect()->route('admin.product.index')->with('message', $message);

    }

    public function createSlug(Request $request){
        return response()->json(['slug' => Str::slug($request->name, '-')]);
    }

    public function uploadImage(Request $request){
        if($request->hasFile('upload')){
            $fileOriginalName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($fileOriginalName, PATHINFO_FILENAME);
            $fileName .= '_'.time().'.'.$request->file('upload')->getClientOriginalExtension();

            $request->file('upload')->move(public_path('images/products'), $fileName);

            $url = asset('images/products/'. $fileName);
            return response()->json(['fileName'=>$fileName, 'url'=>$url, 'uploaded'=>1]);
        }
    }

    public function restore(string $id){
        $product = Product::withTrashed()->find($id);
        $check = $product->restore();

        $message = $check > 0 ? 'Khôi phục sản phẩm thành công.' : 'Khôi phục sản phẩm thất bại.';
        return redirect()->route('admin.product.index')->with('message',$message);
    }



}
