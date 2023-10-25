<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('component_id');
            $table->foreign('component_id')->references('id')->on('sections_components')->onDelete('cascade');
            $table->string('field_name');
            $table->text('field_value');
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
        Schema::dropIfExists('component_data');
    }
};
