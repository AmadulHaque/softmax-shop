<?php
namespace App\Services\Pos;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

trait ServiceCustomer
{
    /**
     * Create new user
     * @param array $data
     * 
     * @return App\Models\User $user
     */
    public function createCustomer($data)
    {
        $data = Customer::create($data);
        return $data;
    }
    public function customers()
    {
        $data = Customer::latest()->get();
        return $data;
    }
    public function customer($id)
    {
        $data = Customer::findOrFail($id);
        return $data;
    }
}