<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeocutilRecordingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geocutil_recordings', function (Blueprint $table) {
            $table->id();
            $table->string("sessionid");
            $table->integer("no");
            $table->string("versant")->nullable();
            $table->string("parent")->nullable();
            $table->string("child")->nullable();
            $table->string("type")->nullable();
            $table->string("type_inter")->nullable();
            $table->string("type_poste")->nullable();
            $table->string("type_troncon")->nullable();
            $table->string("nom")->nullable();
            $table->char("etat",1)->nullable();
            $table->string("code_gdo")->nullable();
            $table->string("depart")->nullable();
            $table->string("poste_secours")->nullable();
            $table->string("depart_secours")->nullable();
            $table->string("code_gdo_depart_secours")->nullable();
            $table->string("clients_number");
            $table->string("child_number");
            $table->string("puissance");
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geocutil_recordings');
    }
}
