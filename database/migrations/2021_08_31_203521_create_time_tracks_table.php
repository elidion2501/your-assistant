<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_tracks', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('time_track_type_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->dateTime('time_from');
            $table->dateTime('time_to');
            $table->mediumText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('id');
            $table->index('slug');
            $table->index('user_id');
            $table->index('time_track_type_id');

            $table->foreign('time_track_type_id')->references('id')->on('time_track_types');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_tracks');
    }
}
