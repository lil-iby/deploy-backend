<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilisateursTable extends Migration
{
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('email')->unique();
            $table->string('mot_de_passe');
            $table->enum('role', ['admin', 'gestionnaire', 'invité']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('utilisateurs');
    }
}
