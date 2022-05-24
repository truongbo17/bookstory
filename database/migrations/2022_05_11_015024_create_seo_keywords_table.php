<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_keywords', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('slug');
            $table->string('title_hash')->index();
            $table->unsignedInteger('length')->index()->default(0);

            $table->integer('documents_matched')->default(0);
            $table->bigInteger('view')->default(0); //count view

            $table->integer('status')->default(0);
            $table->string('hits')->nullable();//json data

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
        Schema::dropIfExists('seo_keywords');
    }
};
