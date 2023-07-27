<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

trait ServiceProduct
{
    /**
     * Create new user
     * @param array $data
     * 
     * @return App\Models\User $user
     */
    public function createProducts($data)
    {
        $data = Product::create($data);
        return $data;
    }
    public function products()
    {
        $data = Product::all();
        return $data;
    }
    public function product($id)
    {
        $data = Product::findOrFail($id);
        return $data;
    }
}