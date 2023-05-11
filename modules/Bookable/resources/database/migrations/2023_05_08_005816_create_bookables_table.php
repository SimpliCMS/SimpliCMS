<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Bookable\Models\BookableState;

class CreateBookablesTable extends Migration {

    public function up() {
        Schema::create('bookables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('sku')->nullable();
            $table->decimal('price', 15, 4)->nullable();
            $table->decimal('original_price', 15, 4)->nullable();
            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->enum('state', BookableState::values())->nullable();
            $table->string('ext_title', 511)->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down() {
        //
    }

}
