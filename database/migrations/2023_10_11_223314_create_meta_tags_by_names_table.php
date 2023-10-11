<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('meta_tags_by_names', function (Blueprint $table) {
            $table->id();
            $table->string('keywords');
            $table->string('robots');
            $table->string('google-site-verification')->nullable();
            $table->string('revisit-after')->nullable();
            $table->string('generator')->nullable();
            $table->string('googlebot')->nullable();
            $table->string('mssmarttagspreventparsing')->nullable();
            $table->string('no-cache')->nullable();
            $table->string('google')->nullable();
            $table->string('googlebot-news')->nullable();
            $table->string('verify-v1')->nullable();
            $table->string('rating')->nullable();
            $table->string('department')->nullable();
            $table->string('audience')->nullable();
            $table->string('doc_status')->nullable();
            $table->string('twitter:title');
            $table->string('twitter:site');
            $table->string('twitter:url')->nullable();
            $table->string('twitter:image');
            $table->string('twitter:image:alt');
            $table->string('twitter:description');
            $table->string('twitter:card');
            $table->string('title');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meta_tags_by_names');
    }
};
