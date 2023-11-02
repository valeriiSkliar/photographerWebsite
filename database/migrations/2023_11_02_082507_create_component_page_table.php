<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentPageTable extends Migration
{
    public function up()
    {
        Schema::create('component_page', function (Blueprint $table) {
            $table->id();
            $table->foreignId('component_id')->constrained('components')->onDelete('cascade');
            $table->foreignId('page_id')->constrained('pages')->onDelete('cascade');

            $table->unique(['component_id', 'page_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('component_page');
    }
}

