<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->string('b_id', 100);
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->string('isbn');
            $table->longText('description');
            $table->string('category', 100);
            $table->unsignedBigInteger('category_id')->nullable();
            // $table->foreignId('keyword_id')->references('id')->on('keywords');
            $table->string('language', 100);
            $table->string('publishedAt');
            $table->integer('avgReadingTime');
            $table->string('status');
            $table->string('contentType', 100);
            $table->string('hasDigital', 100);
            $table->string('hasRental', 100);
            $table->string('hasHardbound', 100);
            $table->string('hasPaperback', 100);
            $table->string('originCountry', 100);
            $table->string('preview_link');
            $table->integer('lowerLimit');
            $table->integer('upperLimit');
            $table->string('isActivated', 100);
            $table->string('slug');
            $table->timestamps();
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
