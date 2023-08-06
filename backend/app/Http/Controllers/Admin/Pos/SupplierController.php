<?php

namespace App\Http\Controllers\Admin\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SuccessResource;
use App\Http\Requests\Supplier\AddRequest;
use App\Http\Requests\Supplier\UpdateRequest;
use App\Services\Pos\ServiceSupplier;
use App\Models\Supplier;
class SupplierController extends Controller
{
    use ServiceSupplier;
    public function index()
    {
        $datas = $this->suppliers();
        return view('pages.Supplier',compact('datas'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(AddRequest $request)
    {
        $data = $request->validated();
        $this->createSupplier($data);
        return new SuccessResource($data);
    }
    /**
     * Display the specified resource.
     */
 

    public function show($id)
    {
        $suppliers =  $this->suppliers();
        $data = $this->supplier($id);
        return view('components.Supplier.edit',compact('data','suppliers'));  
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Supplier $supplier)
    {
        $data = $request->validated();
        $supplier->update($data);
        return new SuccessResource($data);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return new SuccessResource(['message' => 'Successfully Supplier deleted.']);
    }
}
