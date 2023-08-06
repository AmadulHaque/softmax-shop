<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
class HomeController extends Controller
{
    //
    public function Home() 
    {
        return view('pages.Dashboard');    
    }

    public function ImgRemove(Request $request)
    {
        @unlink(public_path($request->url));
        return response()->json(
            ['status'=>200,'message' => 'Successfully Product Image deleted.']
        );
    }
    public function CartRemove($id)
    {
       Cart::where('id',$id)->delete();
       return true;
    }
    



}
