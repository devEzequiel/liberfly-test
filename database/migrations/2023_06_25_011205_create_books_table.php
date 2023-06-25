<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('type_id');

            $table->string('name');
            $table->string('author');
            //string instead int (or another num format) for avoid problems when the code be something like '0000123'
            $table->string('code')->unique();
            $table->float('size');

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('type_id')->references('id')->on('file_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
