<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitesTable extends Migration
{
    public function up()
    {
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->unsignedBigInteger('etablissement_id');
            $table->foreign('etablissement_id')->references('id')->on('etablissements')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activites');
    }
}
