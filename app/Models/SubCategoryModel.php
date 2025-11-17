<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SubCategoryModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sub_categories';

    protected $fillable = [
        'title', 
        'slug', 
        'category_id',
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
            $category->slug = Str::slug($category->title);
        });

        static::updating(function ($category) {
            // If the title was changed, regenerate the slug
            if ($category->isDirty('title')) {
                $category->slug = Str::slug($category->title);
            }
        });
        
    }

    public function category(){
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }
}
