<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductDetailImportant\AddRequest;
use App\Http\Requests\ProductDetailImportant\UpdateRequest;
use App\Models\PdImpotrant;
use App\Http\Resources\SuccessResource;
class ProductDetailImportantController extends Controller
{
    
    public function index()
    {
        $datas = PdImpotrant::all();
        return view('pages.PdImpotrant',compact('datas'));
    }
    
    public function store(AddRequest $request)
    {
        $data = $request->validated();
        PdImpotrant::create($data);
        return new SuccessResource($data);
    }
   
    public function show($id)
    {
        $data =PdImpotrant::findOrFail($id);
        return view('components.pdImpotrant.edit',compact('data'));  
    }

    public function update(UpdateRequest $request, $id)
    {
        $data = $request->validated();
        PdImpotrant::where('id',$id)->update($data);
        return new SuccessResource($data);
    }

    public function destroy($id)
    {
        PdImpotrant::where('id',$id)->delete();
        return new SuccessResource(['message' => 'Successfully  deleted.']);
    }
}
