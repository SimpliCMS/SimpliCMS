<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExtendPersonsTable extends Migration {

    public function up() {
        Schema::table('persons', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
            $table->string('gender_value')->nullable();
        });
    }

    public function down() {
        //
    }

}
