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
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('event_category_id')->nullable();
            $table->foreign('event_category_id', 'event_category_fk_7464250')->references('id')->on('event_categories');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id', 'district_fk_7464251')->references('id')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }
};
