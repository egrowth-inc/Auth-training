<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('muscles', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // 部位のキー (例: chest, abs)
            $table->string('name'); // 日本語の部位名
            $table->string('image'); // 画像のファイル名
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muscles');
    }
};
