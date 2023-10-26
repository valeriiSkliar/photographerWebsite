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
            $table->foreignId('sections_components_id')->constrained('sections_components')->onDelete('cascade');
            $table->string('field_name');
            $table->text('field_value');
            $table->timestamps();

            $table->unsignedBigInteger('dataable_id')->nullable();
            $table->string('dataable_type')->nullable();
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
