<?php

namespace App\DTO\User;

class RegisterResponseDTO
{
    public string $token;
    public array $user;

    public function __construct(string $token, array $user)
    {
        $this->token = $token;
        $this->user = $user;
    }
}
