<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniteRegionalsTable extends Migration
{
    public function up()
    {
        Schema::create('unite_regionals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_complet');
            $table->string('tel_1');
            $table->string('tel_2')->nullable();
            $table->string('fix')->nullable();
            $table->string('email')->unique();
            $table->string('email_personnel')->nullable();
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}