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
    public function create( $data)
    {
        $data = Category::create($data);
        return $data;
    }
    public function allData()
    {
        $data = Category::all();
        return $data;
    }
    public function findOne($id)
    {
        $data = Category::findOrFail($id);
        return $data;
    }
}