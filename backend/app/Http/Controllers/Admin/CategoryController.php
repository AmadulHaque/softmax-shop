<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\AddRequest;
use App\Models\Category;
use App\Services\CreateCategory;
use App\Http\Resources\SuccessResource;
use Illuminate\Support\Facades\Storage;
class CategoryController extends Controller
{
    use CreateCategory;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::all();
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
        $categorys =  Category::all();
        $data =  Category::findOrFail($id);
        return view('components.category.edit',compact('data','categorys'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        return  $request->all();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
