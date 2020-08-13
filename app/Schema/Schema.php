<?php

namespace App\Schema;

use Illuminate\Support\Facades\Storage;
use App\GeocutilRecording;
/**
 * this class is responsible for Schema data 
 */
class Schema
{

    /**
     * return geocutil file stream
     */    
        
    
    private function getGeocutilfile(){

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
    
    

       
    public  function getGeocutilMetadata(){
        
        $i = 0;
        $geocutilMeta = array('jdd' => '', 'updated_at' => '');

        if($this->getGeocutilfile() != false){

            $geocutilMeta['updated_at'] = Storage::disk('geocutil')->lastModified('GeocUtil.txt');
            
            $geocutilStream = $this->getGeocutilfile();

            while($i < 2){

                $fileLine = fgets($geocutilStream);
                
                $i++;
            }

            $fileLineExploded = explode("\t", $fileLine);

            $geocutilMeta['jdd'] =  $fileLineExploded[1];
        }

        return $geocutilMeta;
        
    }
    

    private function insertComponent(array $requestPram)
    {
        $nititmp = new GeocutilRecording();
        

    }

    public function temporaryStoreSchemaData($departureGdo, $departureName, $postName ){

        
        $departureNotFound = true;
        $geocutilStream = $this->getGeocutilfile();
        $componentNumber = 1;
        $departureMeta = array( 'departureSitrCode' => '',
                                'departureGdoCode' => '',
                                'departureName' => '',
                                'postName' => '',
                                'centre' => '',
                                );

        while(!feof($geocutilStream)){

            $fileLine = fgets($geocutilStream);
            $fileLineExploded = explode("\t", $fileLine);

            if( $departureNotFound ){

                if(
                    $fileLineExploded[0] == "DEPART" &&
                    $fileLineExploded[2] == $departureGdo &&
                    $fileLineExploded[3] == $departureName){

                    $departureMeta['departureSitrCode']  = $fileLineExploded[2];
                    $departureMeta['departureGdoCode']  = $fileLineExploded[2];
                    $departureMeta['departureName'] = $fileLineExploded[3];
                    $departureMeta['postName']      = $fileLineExploded[4];
                    $departureMeta['centre'] = $fileLineExploded[8];

                    $this->insertComponent($fileLineExploded);
                    $componentNumber++;
                    $departureNotFound = false;
                    
            
            }else{
            
                if(  $fileLineExploded[0] == "DEPART" &&
                     ($fileLineExploded[2] != $departureGdo || $fileLineExploded[3] != $departureName)){

                     break;
                }
                elseif($fileLineExploded[0] == "COU_J" && ($fileLineExploded[5] != 0 || $fileLineExploded[6] != 0)){

                }
            }


         


            }

        }

    }

}
