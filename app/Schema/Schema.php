<?php

namespace App\Schema;

use Illuminate\Support\Facades\Storage;
use App\GeocutilRecording;

/**
 * this class is responsible for Schema data 
 */
class Schema
{

    public $debug = 0;
    /**
     * return geocutil file stream
     */
    private function getGeocutilfile()
    {

        if (Storage::disk('geocutil')->exists('GeocUtil.txt')) {

            $geocutilStream = Storage::disk('geocutil')->readStream('GeocUtil.txt');

            return $geocutilStream;
        }

        return false;
    }

    /**
     * get time of last updated  of geocutil file
     * and jdd : number of data set
     */
    public  function getGeocutilMetadata()
    {

        $i = 0;
        $geocutilMeta = array('jdd' => '', 'updated_at' => '');

        if ($this->getGeocutilfile() != false) {

            $geocutilMeta['updated_at'] = Storage::disk('geocutil')->lastModified('GeocUtil.txt');

            $geocutilStream = $this->getGeocutilfile();

            while ($i < 2) {

                $fileLine = fgets($geocutilStream);

                $i++;
            }

            $fileLineExploded = explode("\t", $fileLine);

            $geocutilMeta['jdd'] =  $fileLineExploded[1];
        }

        return $geocutilMeta;
    }


    private function insertComponent($sessionId, $componentNumber, $sitrCode, $parent, $child, $type, $typeInter, $typePost, $name, $state, $gdoCode, $gdoDeparture, $posteSecours, $departSecours, $gdoDepartSecours, $clientNumber, $childNumber, $power, $typeTroncon)
    {
        $component = new GeocutilRecording();
        $component->sessionid = $sessionId;
        $component->no = $componentNumber;
        $component->versant = $sitrCode;
        $component->parent = $parent;
        $component->child = $child;
        $component->type = $type;
        $component->type_inter = $typeInter;
        $component->type_poste = $typePost;
        $component->type_troncon = $typeTroncon;
        $component->nom = $name;
        $component->etat = $state;
        $component->code_gdo = $gdoCode;
        $component->depart = $gdoDeparture;
        $component->poste_secours = $posteSecours;
        $component->depart_secours = $departSecours;
        $component->code_gdo_depart_secours = $gdoDepartSecours;
        $component->clients_number = $clientNumber;
        $component->child_number = $childNumber;
        $component->puissance = $power;

        $component->save();
    }

    private function positionInterPoste($post, $inter, $posteArray)
    {

        if (in_array($post, $posteArray)) {
            return array('amont' => $post, 'aval' => $inter);
        } else {
            return array('amont' => $inter, 'aval' => $post);
        }
    }
    private function getPosteType($privedOrpublic, $posteType)
    {

        $type = '';

        if ($privedOrpublic == 0) {
            $type = 'prive';
        } else {
            $type = 'public';
        }
        switch ($posteType) {
            case 0:
                return $type . 'poste';
            case 1:
                return $type . 'CH';
            case 2:
                return $type . 'CB';
            case 3:
                return $type . 'IM';
            case 4:
                return $type . 'EN';
            case 5:
                return $type . 'H61';
            case 6:
                return $type . 'PO';
            case 7:
                return $type . 'CC';
            case 8:
                return $type . 'UC';
            case 9:
                return $type . 'RC';
            case 10:
                return $type . 'UP';
            case 11:
                return $type . 'RS';
            case 12:
                return $type . 'PSSA';
            case 13:
                return $type . 'PSSB';
            case 14:
                return $type . 'PRCS';
            case 15:
                return $type . 'UI';
            case 16:
                return $type . 'DIVER';
            default:
                return $type . 'poste';
        }
    }

    public function temporaryStoreSchemaData($departureGdo, $departureName, $postName)
    {

        $noeudjCodeGdoArray = [];
        $interCodeGdoArray = [];
        $postesBT = [];
        $interputeurFictifArray = [];
        $interputeurFictifNumber = 0;
        $departureNotFound = true;
        $geocutilStream = $this->getGeocutilfile();
        $componentNumber = 1;
        $departureMeta = array(
            'departureSitrCode' => '',
            'departureGdoCode' => '',
            'departureName' => '',
            'postName' => '',
            'centre' => '',
        );

        while (!feof($geocutilStream)) {

            $fileLine = fgets($geocutilStream);
            $fileLineExploded = explode("\t", $fileLine);

            if ($departureNotFound) {

                if (
                    $fileLineExploded[0] == "DEPART" &&
                    $fileLineExploded[2] == $departureGdo &&
                    $fileLineExploded[3] == $departureName
                ) {

                    $departureMeta['departureSitrCode']  = $fileLineExploded[1];
                    $departureMeta['departureGdoCode']  = $fileLineExploded[2];
                    $departureMeta['departureName'] = $fileLineExploded[3];
                    $departureMeta['postName']      = $fileLineExploded[4];
                    $departureMeta['centre'] = $fileLineExploded[8];

                    $this->insertComponent(1, $componentNumber, $fileLineExploded[1], null, null, 'depart', null, null, $fileLineExploded[3], 'F', $fileLineExploded[2], $fileLineExploded[2], null, null, null, 0, 0, 0, null);
                    $componentNumber++;
                    $departureNotFound = false;
                }
            } else {

                if (
                    $fileLineExploded[0] == "DEPART" &&
                    ($fileLineExploded[2] != $departureGdo || $fileLineExploded[3] != $departureName)
                ) {

                    break;
                } elseif ($fileLineExploded[0] == "COU_J" && ($fileLineExploded[5] != 0 || $fileLineExploded[6] != 0)) {

                    $state = ($fileLineExploded[18] == 0) ? 'F' : 'O';

                    if ($fileLineExploded[3 == 'NULL']) {

                        $wait = (!in_array($fileLineExploded[2], $postesBT) && $state == 'O' && $fileLineExploded[19] == 'NULL');
                        $positionInterPoste = $this->positionInterPoste($fileLineExploded[2], $fileLineExploded[1], $postesBT);
                    } else {
                        $positionInterPoste = $this->positionInterPoste($fileLineExploded[3], $fileLineExploded[2], $postesBT);
                    }

                    if (($state == 'O' && !in_array($fileLineExploded[4], $interCodeGdoArray) || $state == 'F') && !$wait) {
                        if ($state == 'O') {
                            $interCodeGdoArray[] = $fileLineExploded[4];
                        }

                        $posteSecours = "";
                        $departSecours = "";
                        $gdoSecours = "";
                        if ($fileLineExploded[19] != 'NULL') {

                            if ($fileLineExploded[19] == $departureMeta['departureSitrCode']) {

                                $posteSecours = $departureMeta['postName'];
                                $departSecours = $departureMeta['departureName'];
                                $gdoSecours = $departureMeta['departureGdoCode'];
                            } else {
                                //chercher dans le fichier 
                            }
                        }
                        $this->insertComponent(1, $componentNumber, null, $positionInterPoste['amont'], $positionInterPoste['aval'], 'inter', (($fileLineExploded[10] == 'NO_TC') ? 'inter' : 'omt'), null, $fileLineExploded[9], $state, $fileLineExploded[4], $departureMeta['departureGdoCode'], (($posteSecours) ?  $posteSecours  : null), (($departSecours) ?  $departSecours  : null), (($gdoSecours) ?  $gdoSecours  : null), 0, 0, 0, null);
                        $componentNumber++;
                    }
                    else{
                        $wait = false;
                    }
                } elseif ($fileLineExploded[0] == "NOEUD_J" && ($fileLineExploded[3] = !0 || $fileLineExploded[4] != 0)) {
                    
                    if (!$fileLineExploded[2]) {
                        
                        if (!array_key_exists($fileLineExploded[1], $interputeurFictifArray)) {

                            $interputeurFictifNumber++;
                            $interputeurFictifArray[$fileLineExploded[1]] = 'FICTIF' . $interputeurFictifNumber;
                            $fileLineExploded[2] = 'FICTIF' . $interputeurFictifNumber;
                        } else {
                            $fileLineExploded[2] = $interputeurFictifArray[$fileLineExploded[1]];
                        }
                    }
                        if ($fileLineExploded[17] != 'NULL') {
                            
                            $posteSecours = "";
                            $departSecours = "";
                            $gdoSecours = "";
                            if ($fileLineExploded[19] == $departureMeta['departureSitrCode']) {

                                $posteSecours = $departureMeta['postName'];
                                $departSecours = $departureMeta['departureName'];
                                $gdoSecours = $departureMeta['departureGdoCode'];
                            } else {
                                //chercher dans le fichier 
                            }
                        }
                            $state = ($fileLineExploded[16] == 0) ? 'F' : 'O';
                            if(!array_key_exists($fileLineExploded[2],$noeudjCodeGdoArray)){
                                
                                $this->insertComponent(1, $componentNumber, $fileLineExploded[1], null, null, 'iat', (($fileLineExploded[8] == 'NO_TC') ? 'iat' : 'omt'), null, $fileLineExploded[7], $state, $fileLineExploded[2], $departureMeta['departureGdoCode'], (($posteSecours) ?  $posteSecours  : null), (($departSecours) ?  $departSecours  : null), (($gdoSecours) ?  $gdoSecours  : null), 0, 0, 0, null);
                                if ($state == 'O'){
                                    $noeudjCodeGdoArray[$fileLineExploded[2]] = 1;
                                } 
                            }
                            $componentNumber++;
                        
                    
                } elseif ($fileLineExploded[0] == "NOEUD_E" && ($fileLineExploded[3] = !0 || $fileLineExploded[4] != 0)) {

                    $this->insertComponent(1, $componentNumber, $fileLineExploded[1], null, null, 'noeud', null, null, null, null, $fileLineExploded[2], $departureMeta['departureGdoCode'], null, null, null, 0, 0, 0, null);
                    $componentNumber++;
                } elseif ($fileLineExploded[0] == "NOEUD_Y" && ($fileLineExploded[3] = !0 || $fileLineExploded[4] != 0)) {

                    $this->insertComponent(1, $componentNumber, $fileLineExploded[1], $fileLineExploded[10], $fileLineExploded[11], 'autotransfo', null, null, null, null, $fileLineExploded[2], $departureMeta['departureGdoCode'], null, null, null, 0, 0, 0, null);
                    $componentNumber++;
                } elseif ($fileLineExploded[0] == "TRONCON") {

                    $this->insertComponent(1, $componentNumber, null, $fileLineExploded[1], $fileLineExploded[2], 'troncon', null, null, null, null, null, $departureMeta['departureGdoCode'], null, null, null, 0, 0, 0, $fileLineExploded[3]);
                    $componentNumber++;
                } elseif ($fileLineExploded[0] == "NOEUD_P" && ($fileLineExploded[3] = !0 || $fileLineExploded[4] != 0)) {

                    $postesBT[] = $fileLineExploded[1];
                    $typePoste = $this->getPosteType($fileLineExploded[8], $fileLineExploded[9]);
                    $this->insertComponent(1, $componentNumber, $fileLineExploded[1], null, null, 'poste', null, $typePoste, $fileLineExploded[7], null, $fileLineExploded[2], $departureMeta['departureGdoCode'], null, null, null, $fileLineExploded[10], 0, $fileLineExploded[13], null);
                    $componentNumber++;
                }
            }
        }
    }
}
