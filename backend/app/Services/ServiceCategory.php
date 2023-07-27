<?php
namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;


trait ServiceCategory
{
    /**
     * Create new user
     * @param array $data
     * 
     * @return App\Models\User $user
     */
    public function createCategory( $data)
    {
        $data = Category::create($data);
        return $data;
    }
    public function categorys()
    {
        $data = Category::all();
        return $data;
    }
    public function category($id)
    {
        $data = Category::findOrFail($id);
        return $data;
    }
}