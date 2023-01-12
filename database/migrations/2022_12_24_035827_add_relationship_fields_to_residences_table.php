<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residences', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->nullable();
//            $table->foreign('country_id', 'country_fk_7786187')->references('id')->on('countries');
            $table->unsignedBigInteger('state_id')->nullable();
//            $table->foreign('state_id', 'state_fk_7786188')->references('id')->on('states');
            $table->unsignedBigInteger('city_id')->nullable();
//            $table->foreign('city_id', 'city_fk_7786189')->references('id')->on('cities');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7792442')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('residences', function (Blueprint $table) {
            //
        });
    }
};
