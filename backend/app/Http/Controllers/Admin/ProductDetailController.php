<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductDetail\AddRequest;
use App\Http\Requests\ProductDetail\UpdateRequest;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\BookNews;
use App\Models\BookReview;
use App\Models\Gift;
use App\Models\PdImpotrant;
use App\Models\PdLearn;
use App\Models\QuationAns;
use App\Http\Resources\SuccessResource;

class ProductDetailController extends Controller
{
    
    public function index()
    {
        $product = Product::all();
        $datas = ProductDetail::all();
        $BookNews = BookNews::all();
        $BookReview = BookReview::all();
        $Gift = Gift::all();
        $PdImpotrant = PdImpotrant::all();
        $PdLearn = PdLearn::all();
        $QuationAns = QuationAns::all();
        return view('pages.ProductDetail',compact('datas','product','BookNews','BookReview','Gift','PdImpotrant','PdLearn','QuationAns'));
    }
    public function store(AddRequest $request)
    {
        $data = $request->validated();
        if ($request->file('PD_image_one')) {
            $filename =  uploadSingleImage($request->file('PD_image_one'),'ProductDetail');
            $data['PD_image_one'] = $filename;
        }
        if ($request->file('PD_image_two')) {
            $filename =  uploadSingleImage($request->file('PD_image_two'),'ProductDetail');
            $data['PD_image_two'] = $filename;
        }
        if ($request->file('review_images')) {
            $filename =  uploadSingleImage($request->file('review_images'),'ProductDetail');
            $data['review_images'] = $filename;
        }
        if ($request->file('order_image')) {
            $filename =  uploadSingleImage($request->file('order_image'),'ProductDetail');
            $data['order_image'] = $filename;
        }
        #===============
        if ($request->PD_important_id) {
            $data['PD_important_id'] =  implode(',', $request->PD_important_id);
        }
        if ($request->PD_learn_id) {
            $data['PD_learn_id'] =  implode(',', $request->PD_learn_id);
        }
        if ($request->qa_id) {
            $data['qa_id'] =  implode(',', $request->qa_id);
        }
        if ($request->book_review_id) {
            $data['book_review_id'] =  implode(',', $request->book_review_id);
        }
        if ($request->book_news_id) {
            $data['book_news_id'] =  implode(',', $request->book_news_id);
        }
        ProductDetail::create($data);
        return new SuccessResource($data);
    }
   
    public function show($id)
    {
        $product = Product::all();
        $booknews = BookNews::all();
        $bookreview = BookReview::all();
        $gift = Gift::all();
        $pdimpotrant = PdImpotrant::all();
        $pdlearn = PdLearn::all();
        $quationans = QuationAns::all();
        $data =ProductDetail::findOrFail($id);
        return view('pages.productDetailEdit',compact('data','product','booknews','bookreview','gift','pdimpotrant','pdlearn','quationans'));  
    }

    public function update(UpdateRequest $request, ProductDetail $ProductDetail)
    {
        $data = $request->validated();
        if ($request->file('PD_image_one')) {
            $filename =  uploadSingleImage($request->file('PD_image_one'),'ProductDetail',$ProductDetail->PD_image_one);
            $data['PD_image_one'] = $filename;
        }
        if ($request->file('PD_image_two')) {
            $filename =  uploadSingleImage($request->file('PD_image_two'),'ProductDetail',$ProductDetail->PD_image_two);
            $data['PD_image_two'] = $filename;
        }
        if ($request->file('review_images')) {
            $filename =  uploadSingleImage($request->file('review_images'),'ProductDetail',$ProductDetail->review_images);
            $data['review_images'] = $filename;
        }
        if ($request->file('order_image')) {
            $filename =  uploadSingleImage($request->file('order_image'),'ProductDetail',$ProductDetail->order_image);
            $data['order_image'] = $filename;
        }
        #===============
        if ($request->PD_important_id) {
            $data['PD_important_id'] =  implode(',', $request->PD_important_id);
        }
        if ($request->PD_learn_id) {
            $data['PD_learn_id'] =  implode(',', $request->PD_learn_id);
        }
        if ($request->qa_id) {
            $data['qa_id'] =  implode(',', $request->qa_id);
        }
        if ($request->book_review_id) {
            $data['book_review_id'] =  implode(',', $request->book_review_id);
        }
        if ($request->book_news_id) {
            $data['book_news_id'] =  implode(',', $request->book_news_id);
        }
        $ProductDetail->update($data);
        return new SuccessResource($data);
    }

    public function destroy(ProductDetail $ProductDetail)
    {
        @unlink(public_path($ProductDetail->PD_image_one));
        @unlink(public_path($ProductDetail->PD_image_two));
        @unlink(public_path($ProductDetail->review_images));
        @unlink(public_path($ProductDetail->order_image));
        $ProductDetail->delete();
        return new SuccessResource(['message' => 'Successfully  deleted.']);
    }

}
