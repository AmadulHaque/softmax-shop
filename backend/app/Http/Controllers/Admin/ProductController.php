<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Product\AddRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use App\Services\ServiceProduct;
use App\Services\ServiceCategory;
use App\Services\ServiceBrand;
use App\Services\ServiceUnit;
use App\Http\Resources\SuccessResource;

class ProductController extends Controller
{
    use ServiceProduct,ServiceCategory,ServiceBrand,ServiceUnit;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->products();
        $categorys = $this->categorys();
        $brands = $this->brands();
        $units = $this->units();
        return view('pages.Product',compact('products','categorys','brands','units'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(AddRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = sluguse($data['title']);
        if ($request->size) {
            $data['size'] = implode(',',$request->size);
        }
        if ($request->color) {
            $data['color'] = implode(',',$request->color);
        }
        if ($request->file('thumbnail')) {
            $filename =  uploadSingleImage($request->file('thumbnail') ,'product');
            $data['thumbnail'] = 'images/'.$filename;
        }
        if ($request->file('images')) {
            $uploadedImageNames = uploadMultipleImages($request->file('images'),'product');
            $data['images'] = implode(',',$uploadedImageNames);
        }
        $this->createProduct($data);
        return new SuccessResource($data);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $products =  $this->products();
        $data = $this->product($id);
        return view('components.product.edit',compact('data','products'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['slug'] = sluguse($data['title']);
        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            @unlink(public_path($product->thumbnail));
            $filename = 'product_'.date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('images/'),$filename);
            $data['thumbnail'] = 'images/'.$filename;
        }
        $product->update($data);
        return new SuccessResource($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        @unlink(public_path($product->image));
        return new SuccessResource(['message' => 'Successfully Product deleted.']);
    }



}
