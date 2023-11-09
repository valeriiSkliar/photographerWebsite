<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderToComponentPageTable extends Migration
{
    public function up()
    {
        Schema::table('component_page', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('page_id');
            $table->index('order');
        });
    }

    public function down()
    {
        Schema::table('component_page', function (Blueprint $table) {
            $table->dropIndex(['order']);
            $table->dropColumn('order');
        });
    }
}

