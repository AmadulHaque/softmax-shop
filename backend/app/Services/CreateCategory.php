<?php
namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;


trait CreateCategory
{
    /**
     * Create new user
     * @param array $data
     * 
     * @return App\Models\User $user
     */
    public function create(array $data) : Model
    {
        $data = Category::create($data);
        return $data;
    }
}