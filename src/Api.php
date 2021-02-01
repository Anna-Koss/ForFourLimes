<?php


namespace App;


class Api
{

    public function get(string $host) : array
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $host);
        $result = json_decode(curl_exec($curl), true, 512, JSON_THROW_ON_ERROR);
        curl_close($curl);
//        var_dump($result);
        return $result;

    }

}