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
            $table->string("versant");
            $table->string("parent");
            $table->string("child");
            $table->string("type");
            $table->string("type_inter");
            $table->string("type_poste");
            $table->string("type_troncon");
            $table->string("nom");
            $table->char("etat",1);
            $table->string("code_gdo");
            $table->string("depart");
            $table->string("poste_secours");
            $table->string("depart_secours");
            $table->string("code_gdo_depart_secours");
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
