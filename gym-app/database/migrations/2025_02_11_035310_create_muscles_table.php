<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('muscles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 部位名（例: "chest"）
            $table->text('description'); // 筋トレの説明
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('muscles');
    }
};
