<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rating')->unsigned();
            $table->string('review', 140);
            $table->integer('delivery_profile_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('delivery_profile_id', 'foreign_ratings_deliver')
                ->references('id')
                ->on('delivery_profiles')
                ->onDelete('cascade');
            $table->foreign('user_id', 'foreign_deliver_ratings_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_ratings');
    }
}
