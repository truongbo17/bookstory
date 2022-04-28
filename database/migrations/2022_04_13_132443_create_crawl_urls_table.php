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
        Schema::create('crawl_urls', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("url_id")
                ->nullable()
                ->foreignId('url_id')
                ->references('id')
                ->on('urls');

            $table->text('parent')->nullable();
            $table->text('url');
            $table->string('url_hash')->index();

            $table->tinyInteger('data_status')->default(0)->index();

            $table->integer('status')->default(0)->index();

            $table->integer('visited')->default(0);

            $table->integer('upload_status')->default(0);
            $table->timestamp('uploaded_at')->nullable();

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
        Schema::dropIfExists('crawl_urls');
    }
};
