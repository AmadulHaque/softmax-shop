<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\QuationAns\AddRequest;
use App\Http\Requests\QuationAns\UpdateRequest;
use App\Models\QuationAns;
use App\Http\Resources\SuccessResource;

class QuationAnsController extends Controller
{
    public function index()
    {
        $datas = QuationAns::all();
        return view('pages.QuationAns',compact('datas'));
    }
    
    public function store(AddRequest $request)
    {
        $data = $request->validated();
        QuationAns::create($data);
        return new SuccessResource($data);
    }
   
    public function show($id)
    {
        $data =QuationAns::findOrFail($id);
        return view('components.QuationAns.edit',compact('data'));  
    }

    public function update(UpdateRequest $request, $id)
    {
        $data = $request->validated();
        QuationAns::where('id',$id)->update($data);
        return new SuccessResource($data);
    }

    public function destroy($id)
    {
        QuationAns::where('id',$id)->delete();
        return new SuccessResource(['message' => 'Successfully  deleted.']);
    } 
}
