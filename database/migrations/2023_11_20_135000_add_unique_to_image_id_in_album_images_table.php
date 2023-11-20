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
        Schema::table('album_images', function (Blueprint $table) {
            // Добавление уникальности к столбцу image_id
            $table->unique('image_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('album_images', function (Blueprint $table) {
            // Удаление уникальности с столбца image_id
            $table->dropUnique('album_images_image_id_unique');
        });
    }
};
