<?php

namespace App\Repository;

use App\Handler\TokenHandler;

final class VehicleRepository  {

    /**
     * @var TokenHandler
     */
    private $handler;

    public function __construct(TokenHandler $handler)
    {
        $this->handler = $handler;
    }
    
    public function getVehicles(): array {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('VEHICLE_API_URL'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'idcliente: '.getenv('VEHICLE_API_CLIENT_ID'),
            'login: '.$this->handler->getLogin(),
            'senha: '.$this->handler->getPassword(),
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}