<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincePartnersTable extends Migration
{
    public function up()
    {
        Schema::create('province_partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('tel_1')->nullable();
            $table->longText('adresse')->nullable();
            $table->longText('description');
            $table->string('responsable');
            $table->string('email');
            $table->string('tel_2');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
