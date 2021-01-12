<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationalPartnersTable extends Migration
{
    public function up()
    {
        Schema::create('national_partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('description');
            $table->string('responsable');
            $table->string('email')->nullable();
            $table->string('tel')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}