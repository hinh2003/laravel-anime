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
        Schema::create('chap_movies', function (Blueprint $table) {
        $table->id();
        $table->integer('name_chap');
        $table->text('link_chap');
        $table->foreignId('movie_id')->constrained('movies')->onDelete('cascade');
        $table->timestamps();
    });

                //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //'
        Schema::dropIfExists('chap_movies');
    }
};
