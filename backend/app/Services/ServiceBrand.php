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
    public function create($data)
    {
        $data = Brand::create($data);
        return $data;
    }
    public function allData()
    {
        $data = Brand::all();
        return $data;
    }
    public function findOne($id)
    {
        $data = Brand::findOrFail($id);
        return $data;
    }
}