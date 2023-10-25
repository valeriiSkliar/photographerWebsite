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
        Schema::create('sections_components', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['standard', 'custom']);
            $table->string('name')->unique();
            $table->string('template_name')->unique();
            $table->text('data')->nullable();
            $table->foreignId('section_id')->nullable()->constrained('sections')->onDelete('set null');
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
        Schema::dropIfExists('sections_components');
    }
};
