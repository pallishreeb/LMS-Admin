<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'cover_pic', 'price', 'chapters','category_id','is_published'];

    protected $casts = [
        'chapters' => 'json'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
