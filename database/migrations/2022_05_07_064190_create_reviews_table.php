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
        Schema::create('reviews', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('document_id');
                $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
                $table->string('name');
                $table->string('email');
                $table->text('review');
                $table->integer('rating')->default(4);
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
