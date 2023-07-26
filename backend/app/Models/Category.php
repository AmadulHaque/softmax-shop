<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'slug', 'parent_category', 'status','category_style'];

    // Define the relationship for the parent category
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category', 'id');
    }

    // Define the relationship for the child categories
    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_category', 'id');
    }





}
