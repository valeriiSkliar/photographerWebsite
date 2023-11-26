<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('active_chats', function (Blueprint $table) {
            $table->id();
            $table->string('chat_id');
            $table->boolean('is_chat_active')->nullable()->default(false);
            $table->timestamps();
        });
    }
};
