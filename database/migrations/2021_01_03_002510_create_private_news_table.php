<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivateNewsTable extends Migration
{
    public function up()
    {
        Schema::create('private_news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('content');
            $table->string('video')->nullable();
            $table->datetime('published_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}