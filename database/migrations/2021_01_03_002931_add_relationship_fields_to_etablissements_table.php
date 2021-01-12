<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEtablissementsTable extends Migration
{
    public function up()
    {
        Schema::table('etablissements', function (Blueprint $table) {
            $table->unsignedBigInteger('direction_id')->nullable();
            $table->foreign('direction_id', 'direction_fk_2899998')->references('id')->on('directorates');
            $table->unsignedBigInteger('unite_id')->nullable();
            $table->foreign('unite_id', 'unite_fk_2899999')->references('id')->on('units');
            $table->unsignedBigInteger('profession_id')->nullable();
            $table->foreign('profession_id', 'profession_fk_2900000')->references('id')->on('professions');
        });
    }
}