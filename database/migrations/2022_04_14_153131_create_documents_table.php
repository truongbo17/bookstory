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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('slug')->nullable();
            $table->string("download_link");
            $table->string("content_file"); //description
            $table->string("content_hash"); //description hash
            $table->integer('page')->nullable(); //page of document
            $table->string('binding')->nullable(); //PDF,DOCX
            $table->integer('code')->nullable(); //code of document

            $table->bigInteger('view')->default(0); //count view
            $table->bigInteger('download')->default(0); //count download

            $table->integer('status')->default(0);
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
        Schema::dropIfExists('documents');
    }
};
