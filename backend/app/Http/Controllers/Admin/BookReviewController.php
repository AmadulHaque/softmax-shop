<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookReview\AddRequest;
use App\Http\Requests\BookReview\UpdateRequest;
use App\Models\BookReview;
use App\Http\Resources\SuccessResource;

class BookReviewController extends Controller
{
    public function index()
    {
        $datas = BookReview::all();
        return view('pages.BookReview',compact('datas'));
    }
    public function store(AddRequest $request)
    {
        $data = $request->validated();
        if ($request->file('image')) {
            $filename =  uploadSingleImage($request->file('image') ,'BookReview');
            $data['image'] = $filename;
        }
        BookReview::create($data);
        return new SuccessResource($data);
    }
   
    public function show($id)
    {
        $data =BookReview::findOrFail($id);
        return view('components.BookReview.edit',compact('data'));  
    }

    public function update(UpdateRequest $request, $id)
    {
        $bookR = BookReview::where('id',$id)->first();
        $data = $request->validated();
        if ($request->file('image')) {
            $filename =  uploadSingleImage($request->file('image'),'BookReview', $bookR->image);
            $data['image'] = $filename;
        }
        BookReview::where('id',$id)->update($data);
        return new SuccessResource($data);
    }

    public function destroy($id)
    {
        $bookR = BookReview::where('id',$id)->first();
        BookReview::where('id',$id)->delete();
        @unlink(public_path($bookR->image));
        return new SuccessResource(['message' => 'Successfully  deleted.']);
    }
}
