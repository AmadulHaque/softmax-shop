<?php
namespace App\Services;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;

trait ServiceBrand
{
    /**
     * Create new user
     * @param array $data
     * 
     * @return App\Models\User $user
     */
    public function createBrand($data)
    {
        $data = Brand::create($data);
        return $data;
    }
    public function brands()
    {
        $data = Brand::latest()->get();
        return $data;
    }
    public function brand($id)
    {
        $data = Brand::findOrFail($id);
        return $data;
    }
}