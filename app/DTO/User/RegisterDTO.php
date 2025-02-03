<?php
namespace App\DTO\User;

class RegisterDTO
{
    public string $email;
    public string $password;
    public string $gender;

    public function __construct(array $data)
    {
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->gender = $data['gender'];
    }
}
