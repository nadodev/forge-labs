<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('bio')->nullable();
            $table->string('photo_url')->nullable();
            $table->json('highlights')->nullable();
            $table->json('social_links')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('abouts');
    }
};


