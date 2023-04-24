<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration {

    public function up() {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('target')->nullable();
            $table->string('permission')->nullable();
            $table->boolean('is_internal')->default(false);
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();

            $table->foreign('menu_id')
                    ->references('id')
                    ->on('menus')
                    ->onDelete('cascade');

            $table->foreign('parent_id')
                    ->references('id')
                    ->on('menu_items')
                    ->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('menu_items');
    }

}
