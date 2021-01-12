<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtablissementsTable extends Migration
{
    public function up()
    {
        Schema::create('etablissements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_complet');
            $table->string('tel_1');
            $table->string('tel_2')->nullable();
            $table->string('email_professionel')->unique();
            $table->string('email_personnel')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}