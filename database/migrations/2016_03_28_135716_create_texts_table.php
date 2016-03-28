<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('texts', function (Blueprint $table) {
            $table->engine = 'MYISAM';
            $table->increments('id');
            $table->timestamps();
            $table->text('title');
            $table->text('body');
        });
        DB::statement('ALTER TABLE texts ADD FULLTEXT (title, body)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('texts');
    }
}
