<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_tracks', function (Blueprint $table) {
            $table->id();
            $table->mediumText('description')->nullable();
            $table->string('slug')->unique();
            $table->decimal('money', 14, 2);
            $table->unsignedBigInteger('money_track_type_id')->nullable();
            $table->unsignedBigInteger('money_track_action_type_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('id');
            $table->index('slug');
            $table->index('user_id');
            $table->index('money_track_type_id');
            $table->index('money_track_action_type_id');

            $table->foreign('money_track_type_id')->references('id')->on('money_track_types');
            $table->foreign('money_track_action_type_id')->references('id')->on('money_track_action_types');
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
        Schema::dropIfExists('money_tracks');
    }
}
