<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferedhelpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offeredhelp', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('offer_id');
            $table->integer('help_id');
            $table->string('token');
            $table->boolean('matched')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offeredhelp');
    }
}
