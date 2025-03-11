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
        //
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_category');
            $table->timestamps();
            $table->text('description');

        });
        Schema::create('countries',function(Blueprint $table){
            $table->id();
            $table->string('name_country');
            $table->timestamps();
            $table->text('description');
        });
        Schema::create('statuses',function(Blueprint $table){
            $table->id();
            $table->string('name_satus');
            $table->timestamps();
            $table->text('description');

        });
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name_movie');
            $table->string('pic');
            $table->integer('years');
            $table->text('description');
            // Thiết lập các khóa ngoại
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('country_id')->constrained('countries');
            $table->foreignId('status_id')->constrained('statuses');
            $table->timestamps(); // Đảm bảo rằng đã có timestamps ở đây

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('movies');
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('categories');

        Schema::enableForeignKeyConstraints();
    }

};
