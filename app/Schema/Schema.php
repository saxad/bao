<?php

namespace App\Schema;

use Illuminate\Support\Facades\Storage;

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
    public function getGeocutilMetadata(){
        
        $i = 1;
        $geocutilMeta = array('jdd' => '', 'updated_at' => '');

        if($this->getGeocutilfile() != false){

            $geocutilMeta['pdated_at'] = Storage::disk('geocutil')->lastModified('GeocUtil.txt');
            
            while($i < 2){
                $fileLine = fgets($this->getGeocutilfile());
                $i++;
            }

            $fileLineExploded = explode("\t", $fileLine);

            $geocutilMeta['jdd'] =  $fileLineExploded[1];
        }

        return $geocutilMeta;
        
    }



}
