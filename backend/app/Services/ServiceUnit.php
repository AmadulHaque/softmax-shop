<?php
namespace App\Services;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Model;

trait ServiceUnit
{
    /**
     * Create new user
     * @param array $data
     * 
     * @return App\Models\User $user
     */
    public function createUnit($data)
    {
        $data = Unit::create($data);
        return $data;
    }
    public function units()
    {
        $data = Unit::all();
        return $data;
    }
    public function unit($id)
    {
        $data = Unit::findOrFail($id);
        return $data;
    }
}