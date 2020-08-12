<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeocutilRecording extends Model
{
    protected $fillable = [
        "sessionid",
        "no",
        "versant",
        "parent",
        "child",
        "type",
        "type_inter",
        "type_poste",
        "type_troncon",
        "nom",
        "etat",
        "code_gdo",
        "depart",
        "poste_secours",
        "depart_secours",
        "code_gdo_depart_secours",
        "clients_number",
        "child_number",
        "puissance"
    ];
    
}
