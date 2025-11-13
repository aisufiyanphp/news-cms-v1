<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Carbon\Carbon;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'news';

    protected $fillable = [
        'title', 
        'slug', 
        'category_id', 
        'sub_category_id',
        'publish_date',
        'publish_time',
        'status',
        'publish_end_date',
        'thumbnail',
        'description',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'deleted_at'
    ];   

    protected static function booted(){

        static::creating(function($news){            
            //generate slug
            $news->slug = Str::slug($news->title);
            
            //convert date 
            $news->publish_date = Carbon::createFromFormat('m/d/Y', $news->publish_date)->format("Y-m-d");
            
            //convert time
            $news->publish_time = Carbon::createFromFormat('g:i A', $news->publish_time)->format('H:i:s');                    
        });

        static::updating(function ($news) {
            // If the title was changed, regenerate the slug
            if ($news->isDirty('title')) {
                $news->slug = Str::slug($news->category_title);
            }
        });        
        
    }
}
