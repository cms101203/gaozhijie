<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("abbr");
            $table->integer("pid");
            $table->string("pids");
            $table->integer("xm_type");
            $table->integer("zx_type");
            $table->integer("seq");
            $table->string("title");
            $table->string("keyword");
            $table->text("content");
            $table->integer("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category');
    }
}
