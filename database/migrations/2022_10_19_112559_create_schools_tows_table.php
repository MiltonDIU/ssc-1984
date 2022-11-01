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
        Schema::create('schools_tows', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('district')->nullable();
            $table->string('upazila')->nullable();
            $table->string('eiin')->nullable();
            $table->string('mobile')->nullable();
            $table->string('management')->nullable();
            $table->string('mpo')->nullable();
            $table->string('post_office')->nullable();
            $table->longText('address')->nullable();
            $table->string('is_approve')->nullable();
            $table->string('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools_tows');
    }
};
