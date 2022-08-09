<?php

namespace App\Repository;

use \MongoDB\Client as Mongo;

final class MongoDBConnection {
    
    /**
     * @var \MongoDB\Client
     */
    private $connection;

    public function __construct()
    {
        $host   = getenv("STPLAPP_MONGO_HOST");
        $user   = getenv("STPLAPP_MONGO_USER");
        $pass   = getenv("STPLAPP_MONGO_PWD");
        $port   = getenv("STPLAPP_MONGO_PORT");

        $this->connection = new Mongo("mongodb://{$user}:{$pass}@{$host}:{$port}");
    }

    /**
     * @return \MongoDB\Client
     */
    public function getConnection() {
        return $this->connection;
    }
}