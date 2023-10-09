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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sub_text');
            $table->text('description')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('albums');
    }
};
