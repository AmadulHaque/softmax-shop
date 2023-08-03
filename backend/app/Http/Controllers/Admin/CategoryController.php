<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\AddRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Services\ServiceCategory;
use App\Http\Resources\SuccessResource;
class CategoryController extends Controller
{
    use ServiceCategory;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = $this->categorys();
        return view('pages.Category',compact('categorys'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(AddRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = sluguse($data['name']);
        if ($request->file('image')) {
            $filename =  uploadSingleImage($request->file('image') ,'category');
            $data['image'] =  $filename;
        }
        $this->createCategory($data);
        return new SuccessResource($data);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categorys =  $this->categorys();
        $data = $this->category($id);
        return view('components.category.edit',compact('data','categorys'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();
        $data['slug'] = sluguse($data['name']);
        if ($request->file('image')) {
            $filename =  uploadSingleImage($request->file('image') ,'category', $category->image);
            $data['image'] = $filename;
        }
        $category->update($data);
        return new SuccessResource($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        @unlink(public_path($category->image));
        return new SuccessResource(['message' => 'Successfully Category deleted.']);
    }
}
