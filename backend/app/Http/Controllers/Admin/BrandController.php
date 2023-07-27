<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SuccessResource;
use App\Http\Requests\Brand\AddRequest;
use App\Http\Requests\Brand\UpdateRequest;
use App\Services\ServiceBrand;
use App\Models\Brand;



class BrandController extends Controller
{
    use ServiceBrand;
    
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = $this->allData();
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
            $file = $request->file('image');
            @unlink(public_path('images/'.$data->image));
            $filename = 'category_'.date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('images/'),$filename);
            $data['image'] = 'images/'.$filename;
        }
        $this->create($data);
        return new SuccessResource($data);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brands =  $this->allData();
        $data = $this->findOne($id);
        return view('components.brand.edit',compact('data','brands'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Brand $brand)
    {
        $data = $request->validated();
        $data['slug'] = sluguse($data['name']);
        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path($brand->image));
            $filename = 'brand_'.date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('images/'),$filename);
            $data['image'] = 'images/'.$filename;
        }
        $brand->update($data);
        return new SuccessResource($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        @unlink(public_path($brand->image));
        return new SuccessResource(['message' => 'Successfully Brand deleted.']);
    }

}
