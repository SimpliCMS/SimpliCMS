<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration {

    public function up() {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->char('title');
            $table->char('slug')->index();
            $table->text('content');
            $table->dateTime('published_at')->nullable();
            $table->softDeletesTz();
            $table->timestamps();
        });
    }

    public function down() {
        //
    }

}
