<?php 

namespace App\Service;

class ViaCEP{

    public static function consultarCEP($cep){
        
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://viacep.com.br/ws/'.$cep.'/json/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        //tranformar em array
        $array = json_decode($response,true);

        return isset($array['cep']) ? $array : null;
    }



}