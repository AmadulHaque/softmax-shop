<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Gift\AddRequest;
use App\Http\Requests\Gift\UpdateRequest;
use App\Models\Gift;
use App\Models\ProductDetail;
use App\Http\Resources\SuccessResource;
class GiftController extends Controller
{
    public function index()
    {
        $datas = Gift::all();
        return view('pages.Gift',compact('datas'));
    }
    
    public function store(AddRequest $request)
    {
        $data = $request->validated();
        Gift::create($data);
        return new SuccessResource($data);
    }
   
    public function show($id)
    {
        $data =Gift::findOrFail($id);
        return view('components.Gift.edit',compact('data'));  
    }

    public function update(UpdateRequest $request, $id)
    {
        $data = $request->validated();
        Gift::where('id',$id)->update($data);
        return new SuccessResource($data);
    }

    public function destroy($id)
    {
        $pd = ProductDetail::where('product_id',$product->id)->count();
        if ($pd > 0) {
            return new SuccessResource(['message' => 'Associate with Product-Detail.']);
        }else{
            Gift::where('id',$id)->delete();
            return new SuccessResource(['message' => 'Successfully  deleted.']);
        }
    } 
}
