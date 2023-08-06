<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title','thumbnail','images','summery','description','category_id','brand_id','unit_id','size','color','qty','price','offer_price','slug','tags','meta_title','meta_keyword','meta_desc','status','trending'];

    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id','id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function brand(){
       return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function productDetail()
    {
        return $this->hasOne(ProductDetail::class, 'product_id');
    }
    
}
