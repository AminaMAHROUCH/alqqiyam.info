<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProvincePartnersTable extends Migration
{
    public function up()
    {
        Schema::table('province_partners', function (Blueprint $table) {
            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id', 'region_fk_2899524')->references('id')->on('regions');
        });
          
    }
}