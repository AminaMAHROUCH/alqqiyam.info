<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('procedure')->nullable();
            $table->string('video_procedure')->nullable();
            $table->longText('description');
            $table->string('video_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}