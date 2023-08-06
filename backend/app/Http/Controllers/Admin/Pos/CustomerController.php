<?php

namespace App\Http\Controllers\Admin\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SuccessResource;
use App\Http\Requests\Customer\AddRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Services\Pos\ServiceCustomer;
use App\Models\Customer;

class CustomerController extends Controller
{
    use ServiceCustomer;
    public function index()
    {
        $datas = $this->customers();
        return view('pages.Customer',compact('datas'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(AddRequest $request)
    {
        $data = $request->validated();
        $this->createCustomer($data);
        return new SuccessResource($data);
    }
    /**
     * Display the specified resource.
     */
 

    public function show($id)
    {
        $customers =  $this->customers();
        $data = $this->customer($id);
        return view('components.Customer.edit',compact('data','customers'));  
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Customer $customer)
    {
        $data = $request->validated();
        $customer->update($data);
        return new SuccessResource($data);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return new SuccessResource(['message' => 'Successfully Customer deleted.']);
    }
}
