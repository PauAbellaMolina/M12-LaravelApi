<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecompensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recompenses', function (Blueprint $table) {
            $table->id();
            $table->integer('id_commerce')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->integer('points')->unsigned();
            $table->longText('picture')->nullable()->default(null);
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
        Schema::dropIfExists('recompenses');
    }
}
