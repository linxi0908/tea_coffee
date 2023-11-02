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
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->string('email',255)->nullable();
            $table->string('hotline',255)->nullable();
            $table->string('phone',255)->nullable();
            $table->string('zalo',255)->nullable();
            $table->string('chatzalo',255)->nullable();
            $table->string('website',255)->nullable();
            $table->string('fanpage',255)->nullable();
            $table->string('chatfacebook',255)->nullable();
            $table->string('googlemap',255)->nullable();
            $table->text('googleiframe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information');
    }
};
