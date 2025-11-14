<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        });

        static::updating(function ($news) {
            // If the title was changed, regenerate the slug
            if ($news->isDirty('title')) {
                $news->slug = Str::slug($news->title);
            }
        });        
        
    }

    protected function publishDate(): Attribute{
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->format('m/d/Y') : null,
            set: fn ($value) => $value ? Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d') : null
        );
    }

    protected function publishTime(): Attribute{
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->format('g:i A') : null,
            set: fn ($value) => $value ? Carbon::createFromFormat('g:i A', $value)->format('H:i:s') : null
        );
    }

    protected function publishEndDate(): Attribute{
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->format('m/d/Y') : null,
            set: fn ($value) => $value ? Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d') : null
        );
    }    
}
