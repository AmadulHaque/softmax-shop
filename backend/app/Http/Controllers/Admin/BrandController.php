<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SuccessResource;
use App\Http\Requests\Brand\AddRequest;
use App\Http\Requests\Brand\UpdateRequest;
use App\Services\ServiceBrand;
use App\Models\Brand;
use App\Models\Product;



class BrandController extends Controller
{
    use ServiceBrand;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = $this->brands();
        return view('pages.Brand',compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = sluguse($data['name']);
        if ($request->file('image')) {
            $filename =  uploadSingleImage($request->file('image') ,'brand');
            $data['image'] =  $filename;
        }
        $this->createBrand($data);
        return new SuccessResource($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brands =  $this->brands();
        $data = $this->brand($id);
        return view('components.brand.edit',compact('data','brands'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Brand $brand)
    {
        $data = $request->validated();
        if ($request->file('image')) {
            $filename =  uploadSingleImage($request->file('image') ,'brand',$brand->image);
            $data['image'] = $filename;
        }
        $brand->update($data);
        return new SuccessResource($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $pc = Product::where('brand_id',$brand->id)->count();
        if ($pc > 0) {
            return new SuccessResource(['message' => 'Associate with Product.']);
        }else{
            $brand->delete();
            @unlink(public_path($brand->image));
            return new SuccessResource(['message' => 'Successfully Brand deleted.']);
        }
    }

}
