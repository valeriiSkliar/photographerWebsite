<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('meta_tags', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->string('name')->nullable();
            $table->string('property')->nullable();
            $table->string('http-equiv')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meta_tags');
    }
};
