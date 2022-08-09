<?php

namespace App\Handler;

final class TokenHandler {

    /**
     * @var string
     */
    private $login;
    /**
     * @var string
     */
    private $password;

    public function __construct()
    {
        $expldToken = explode(":", $this->decodeToken());

        $this->login = $expldToken[0];
        $this->password = $expldToken[1];
    }

    private function decodeToken() {
        return base64_decode(getenv('VEHICLE_API_TOKEN'));
    }

    /**
     * @return string
     */
    public function getLogin(): string {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }
}