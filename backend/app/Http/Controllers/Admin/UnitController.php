<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SuccessResource;
use App\Http\Requests\Unit\AddRequest;
use App\Http\Requests\Unit\UpdateRequest;
use App\Services\ServiceUnit;
use App\Models\Unit;
use App\Models\Product;

class UnitController extends Controller
{
    use ServiceUnit;
    public function index()
    {
        $units = $this->units();
        return view('pages.Unit',compact('units'));
    }

 
    /**
     * Store a newly created resource in storage.
     */
    public function store(AddRequest $request)
    {
        $data = $request->validated();
        $this->createUnit($data);
        return new SuccessResource($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $units =  $this->units();
        $data = $this->unit($id);
        return view('components.unit.edit',compact('data','units'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Unit $unit)
    {
        $data = $request->validated();
        $unit->update($data);
        return new SuccessResource($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $pc = Product::where('unit_id',$brand->id)->count();
        if ($pc > 0) {
            return new SuccessResource(['message' => 'Associate with Product.']);
        }else{
            $unit->delete();
            return new SuccessResource(['message' => 'Successfully Unit deleted.']);
        }
    }

}
