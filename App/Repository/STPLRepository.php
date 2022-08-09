<?php

namespace App\Repository;

final class STPLRepository {

    /**
     * @var MongoDBConnection
     */
    private $connection;

    public function __construct(MongoDBConnection $connection)
    {
        $this->connection = $connection->getConnection();
    }

    public function batchInsert(array $vehicles)
    {
        $db = $this->connection->stplapp;
        
        foreach($vehicles['veiculos'] as $key => $vehicle) {
            $utcdatetime = new \MongoDB\BSON\UTCDateTime($vehicle["dataHora"]);
            $data[] = array(
                'metadata' => array(
                    'codigo' => $vehicle['codigo'],
                    'placa'  => $vehicle['placa'],
                    'linha'  => $vehicle['linha'],
                    'id_migracao_trajeto' => $vehicle['id_migracao_trajeto'],
                    'sentido' => $vehicle['sentido'],
                    'trajeto' => $vehicle['trajeto']
                ), 
                'timestamp' => $utcdatetime, 
                'latitude' => $vehicle["latitude"], 
                'longitude' => $vehicle["longitude"], 
                'velocidade'=> $vehicle["velocidade"]
            );
        }

        $db->stpltable->insertMany($data);
    }
}