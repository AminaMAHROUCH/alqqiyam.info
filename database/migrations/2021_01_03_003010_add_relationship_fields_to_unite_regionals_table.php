<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUniteRegionalsTable extends Migration
{
    public function up()
    {
        Schema::table('unite_regionals', function (Blueprint $table) {
            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id', 'region_fk_2900012')->references('id')->on('regions');
            $table->unsignedBigInteger('province_id')->nullable();
            $table->foreign('province_id', 'province_fk_2900013')->references('id')->on('provinces');
        });
    }
}