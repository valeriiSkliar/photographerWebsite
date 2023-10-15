<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('meta_tags', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type');
            $table->string('value')->nullable();
            $table->string('content');
            $table->foreignId('page_id')->nullable()->constrained('pages')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meta_tags');
    }
};
