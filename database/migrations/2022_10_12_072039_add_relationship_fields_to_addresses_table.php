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
        Schema::table('addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('division_id')->nullable();
            $table->foreign('division_id', 'division_fk_7464087')->references('id')->on('divisions');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id', 'district_fk_7464088')->references('id')->on('districts');
            $table->unsignedBigInteger('upazila_id')->nullable();
            $table->foreign('upazila_id', 'upazila_fk_7464089')->references('id')->on('upazilas');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7481860')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7464097')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            //
        });
    }
};
