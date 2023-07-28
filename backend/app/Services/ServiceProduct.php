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
    public function createProduct($data)
    {
        $data = Product::create($data);
        return $data;
    }
    public function products()
    {
        $data = Product::latest()->get();
        return $data;
    }
    public function product($id)
    {
        $data = Product::findOrFail($id);
        return $data;
    }
}