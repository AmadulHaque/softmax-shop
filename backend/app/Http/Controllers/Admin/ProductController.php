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
        $categorys = $this->categorys();
        $brands = $this->brands();
        $units = $this->units();
        $data = $this->product($id);
        return view('pages.productEdit',compact('data','categorys','brands','units'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['slug'] = sluguse($data['title']);
        if ($request->file('thumbnail')) {
            $filename =  uploadSingleImage($request->file('thumbnail') ,'product');
            $data['thumbnail'] = 'images/'.$filename;
        }
        if ($request->old_images) {
            $old_image = implode(',',$request->old_images);
        }else{
            $old_image = $product->images;
        }
        if ($request->file('images')) {
            $uploadedImageNames = uploadMultipleImages($request->file('images'),'product');
            $data['images'] = implode(',',$uploadedImageNames).','.$old_image;
        }else{
            $data['images'] = $old_image;
        }


        $product->update($data);
        return new SuccessResource($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        @unlink(public_path($product->thumbnail));
        $images=explode(',',$product->images);
        foreach ($images as $file) {
            @unlink(public_path($file));
        }
        $product->delete();
        return new SuccessResource(['message' => 'Successfully Product deleted.']);
    }



}
