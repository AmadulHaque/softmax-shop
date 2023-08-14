<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PdImpotrant;
use App\Models\PdLearn;
use App\Models\Gift;
use App\Models\QuationAns;
use App\Models\BookReview;
use App\Models\BookNews;
use App\Models\ProductDetail;
class ProductController extends Controller
{
    function ProductGetByOne($slug){
        $product = Product::where('slug',$slug)->first();
        if ($product) {
            if ($product->ProductDetail) {
                if ($product->ProductDetail['PD_important_id']) {
                    $PdImpotrant = PdImpotrant::whereIn('id',explode(',',$product->ProductDetail['PD_important_id']))->get();
                }else{
                    $PdImpotrant = [];
                }
                if ($product->ProductDetail['PD_learn_id']) {
                    $PdLearn = PdLearn::whereIn('id',explode(',',$product->ProductDetail['PD_learn_id']))->get();
                }else{
                    $PdLearn = [];
                }
                if ($product->ProductDetail['qa_id']) {
                    $QuationAns = QuationAns::whereIn('id',explode(',',$product->ProductDetail['qa_id']))->get();
                }else{
                    $QuationAns = [];
                }
                if ($product->ProductDetail['book_review_id']) {
                    $BookReview = BookReview::whereIn('id',explode(',',$product->ProductDetail['book_review_id']))->get();
                }else{
                    $BookReview = [];
                }
                if ($product->ProductDetail['book_review_id']) {
                    $BookNews = BookNews::whereIn('id',explode(',',$product->ProductDetail['book_news_id']))->get();
                }else{
                    $BookNews = [];
                }
                $gift = Gift::where('id',$product->ProductDetail['gift_id'])->first();
                return response()->json([
                    'status'=>200,
                    'data'=>$product,
                    'details'=>$product->ProductDetail,
                    'important'=>$PdImpotrant,
                    'PdLearn'=>$PdLearn,
                    'QuationAns'=>$QuationAns,
                    'BookReview'=>$BookReview,
                    'BookNews'=>$BookNews,
                    'gift'=>$gift,
                ]);
            }else{
                return response()->json([
                    'status'=>200,
                    'data'=>$product,
                    'details'=>[],
                    'important'=>[],
                    'PdLearn'=>[],
                    'QuationAns'=>[],
                    'BookReview'=>[],
                    'BookNews'=>[],
                    'gift'=>[],
                ]);
            }
        }else{
            return response()->json([
                'status'=>404,
                'data'=>[],
                'details'=>[],
                'important'=>[],
                'PdLearn'=>[],
                'QuationAns'=>[],
                'BookReview'=>[],
                'BookNews'=>[],
                'gift'=>[],
            ]);
        }
    }

    public function products()
    {
        $product = Product::get();
        return response()->json([
            'status'=>404,
            'data'=>$product,
        ]);
    }



}
