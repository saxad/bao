<?php

namespace App\Schema;

use Illuminate\Support\Facades\Storage;

/**
 * this class is responsible for geocutil file traitment
 */
class Post
{

    public static function getPosts()
    {
        /**
         * les posts in geocutil file
         */
        $posts = array();

        if (Storage::disk('geocutil')->exists('GeocUtil.txt')) {

            $geocutilStream = Storage::disk('geocutil')->readStream('GeocUtil.txt');

            while (!feof($geocutilStream)) {

                $fileLine = fgets($geocutilStream);
                $tmpData = explode("\t", $fileLine);

                if ($tmpData[0] == "DEPART" && !in_array($tmpData[4], $posts)) {
                    array_push($posts, $tmpData[4]);
                }
            }
        } else {
            dd('file note found');
        }
        sort($posts, SORT_STRING);

        return $posts;
    }

    public static function getDepartue($poste)
    {
        $departureArray = [];
        $departureObject = array("name" => "", "gdo" => "");
        $oneDepartureFound = false;

        if (Storage::disk('geocutil')->exists('GeocUtil.txt')) {

            $geocutilStream = Storage::disk('geocutil')->readStream('GeocUtil.txt');
        }
        while (!feof($geocutilStream)) {
            $fileLine = fgets($geocutilStream);
            $tmpData = explode("\t", $fileLine);
            if ($tmpData[0] == "DEPART") {
                if ($tmpData[4] == $poste && $tmpData[2] != "") {

                    $departureObject['name'] = $tmpData[3];
                    $departureObject['gdo'] = $tmpData[2];

                    array_push($departureArray, $departureObject);
                    $oneDepartureFound = true;
                } elseif ($tmpData[4] != $poste && $oneDepartureFound) {
                    break;
                }
            }
        }
        return  json_encode($departureArray);
    }
}
