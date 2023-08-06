<?php
namespace App\Services\Pos;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;

trait ServiceSupplier
{
    /**
     * Create new user
     * @param array $data
     * 
     * @return App\Models\User $user
     */
    public function createSupplier($data)
    {
        $data = Supplier::create($data);
        return $data;
    }
    public function suppliers()
    {
        $data = Supplier::latest()->get();
        return $data;
    }
    public function supplier($id)
    {
        $data = Supplier::findOrFail($id);
        return $data;
    }
}