<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PDLearn\AddRequest;
use App\Http\Requests\PDLearn\UpdateRequest;
use App\Models\PdLearn;
use App\Http\Resources\SuccessResource;

class PdLearnController extends Controller
{
    public function index()
    {
        $datas = PdLearn::all();
        return view('pages.PdLearn',compact('datas'));
    }
    
    public function store(AddRequest $request)
    {
        $data = $request->validated();
        PdLearn::create($data);
        return new SuccessResource($data);
    }
   
    public function show($id)
    {
        $data =PdLearn::findOrFail($id);
        return view('components.PdLearn.edit',compact('data'));  
    }

    public function update(UpdateRequest $request, $id)
    {
        $data = $request->validated();
        PdLearn::where('id',$id)->update($data);
        return new SuccessResource($data);
    }

    public function destroy($id)
    {
        PdLearn::where('id',$id)->delete();
        return new SuccessResource(['message' => 'Successfully  deleted.']);
    } 
}
