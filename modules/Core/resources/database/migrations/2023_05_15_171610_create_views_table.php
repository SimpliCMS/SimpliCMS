<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewsTable extends Migration {

    public function up() {
        Schema::create('views', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('viewable');
            $table->text('visitor')->nullable();
            $table->string('collection')->nullable();
            $table->timestamp('viewed_at')->useCurrent();
        });
    }

    public function down() {
        Schema::dropIfExists('views');
    }

}
