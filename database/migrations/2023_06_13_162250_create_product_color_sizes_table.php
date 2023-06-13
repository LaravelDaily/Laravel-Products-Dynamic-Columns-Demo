<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_color_sizes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('color_id')->constrained('product_colors')->onDelete('cascade');
            $table->foreignId('size_id')->constrained('product_sizes')->onDelete('cascade');
            $table->string('reference_number');

            $table->timestamps();
        });
    }
};
