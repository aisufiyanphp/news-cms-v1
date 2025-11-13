<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {

            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->date('publish_date');            
            $table->time('publish_time');
            $table->boolean('status')->default(1);            
            $table->date('publish_end_date');
            $table->string('thumbnail')->nullable();                        
            $table->text('description');            

            // SEO fields
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->softDeletes();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
