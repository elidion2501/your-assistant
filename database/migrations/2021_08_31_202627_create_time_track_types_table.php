<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeTrackTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_track_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_name');
            $table->string('slug')->unique();
            $table->timestamps();
            $table->softDeletes();

            $table->index('id');
            $table->index('slug');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_track_types');
    }
}
