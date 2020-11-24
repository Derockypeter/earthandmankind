<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('audio_path');
            $table->string('cover_image');
            $table->unsignedBigInteger('language_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('language_id')->references('id')->on('languages')->onCascade('update');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audio');
    }
}
