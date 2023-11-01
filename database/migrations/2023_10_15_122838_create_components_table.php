<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('name');
//            $table->string('type');
//            $table->enum('type', ['album', 'form', 'custom']);

//            $table->enum('type', ['standard', 'custom']);
//            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
            $table->foreignId('album_id')->nullable()->constrained('albums')->onDelete('set null');
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
