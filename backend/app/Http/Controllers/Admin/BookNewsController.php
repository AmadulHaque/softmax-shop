<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookNews\AddRequest;
use App\Http\Requests\BookNews\UpdateRequest;
use App\Models\BookNews;
use App\Http\Resources\SuccessResource;
class BookNewsController extends Controller
{
    
    public function index()
    {
        $datas = BookNews::all();
        return view('pages.BookNews',compact('datas'));
    }
    
    public function store(AddRequest $request)
    {
        $data = $request->validated();
        if ($request->file('image')) {
            $filename =  uploadSingleImage($request->file('image') ,'BookNews');
            $data['image'] = $filename;
        }
        BookNews::create($data);
        return new SuccessResource($data);
    }
   
    public function show($id)
    {
        $data =BookNews::findOrFail($id);
        return view('components.BookNews.edit',compact('data'));  
    }

    public function update(UpdateRequest $request, $id)
    {
        $bookR = BookNews::where('id',$id)->first();
        $data = $request->validated();
        if ($request->file('image')) {
            $filename =  uploadSingleImage($request->file('image'),'BookNews', $bookR->image);
            $data['image'] = $filename;
        }
        BookNews::where('id',$id)->update($data);
        return new SuccessResource($data);
    }

    public function destroy($id)
    {
        $bookR = BookNews::where('id',$id)->first();
        BookNews::where('id',$id)->delete();
        @unlink(public_path($bookR->image));
        return new SuccessResource(['message' => 'Successfully  deleted.']);
    }

}
