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
        Schema::table('images', function (Blueprint $table) {
//            $table->foreignId('album_id')->nullable()->constrained()->onDelete('set null');
        });

        Schema::table('albums', function (Blueprint $table) {
//            $table->foreignId('cover_image_id')->nullable()->constrained('images')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
//            $table->dropForeign(['album_id']);
        });

        Schema::table('albums', function (Blueprint $table) {
//            $table->dropForeign(['cover_image_id']);
        });
    }
};
