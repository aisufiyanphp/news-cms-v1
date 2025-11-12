<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'category_title', 
        'slug', 
        'description', 
        'status',
        'order',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'deleted_at'
    ];

    protected static function booted(){

        static::creating(function($category){
            $category->slug = Str::slug($category->category_title);
        });

        static::updating(function ($category) {
            // If the title was changed, regenerate the slug
            if ($category->isDirty('category_title')) {
                $category->slug = Str::slug($category->category_title);
            }
        });
        
    }
}
