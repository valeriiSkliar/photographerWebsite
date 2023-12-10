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
        Schema::create('component_detail_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('component_detail_id')->constrained('component_details')->onDelete('cascade');
            $table->string('locale')->index();
            $table->text('translated_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_detail_translations');
    }
};
