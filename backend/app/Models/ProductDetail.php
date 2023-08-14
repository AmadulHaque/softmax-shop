<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function important()
    {
        return $this->belongsTo(PdImpotrant::class, 'PD_important_id');
    }

    public function learn()
    {
        return $this->belongsTo(PdLearn::class, 'PD_learn_id');
    }

    public function gift()
    {
        return $this->Gift(Gift::class);
    }

    public function qa()
    {
        return $this->belongsTo(QuationAns::class, 'qa_id');
    }

    public function bookReview()
    {
        return $this->belongsTo(BookReview::class, 'book_review_id');
    }

    public function bookNews()
    {
        return $this->belongsTo(BookNews::class, 'book_news_id');
    }



}
