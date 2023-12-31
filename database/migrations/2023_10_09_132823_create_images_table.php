<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('file_url');
            $table->string('file_url_medium');
            $table->string('file_url_small');
            $table->integer('rank')->nullable();
            $table->string('title')->nullable();
            $table->string('alt_text')->nullable();
            $table->text('metadata')->nullable();
            $table->string('status')->nullable();
            $table->string('visibility')->nullable();
            $table->softDeletes();

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
        Schema::dropIfExists('images');
    }
};
