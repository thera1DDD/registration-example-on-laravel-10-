<?php
namespace App\Services;

use App\DTO\User\RegisterDTO;
use App\DTO\User\RegisterResponseDTO;
use App\Repositories\UserRepository;
use App\Transformers\UserTransformer;

class UserService
{
    private UserRepository $userRepository;
    private UserTransformer $userTransformer;

    public function __construct(UserRepository $userRepository, UserTransformer $userTransformer)
    {
        $this->userRepository = $userRepository;
        $this->userTransformer = $userTransformer;
    }

    public function register(RegisterDTO $dto): RegisterResponseDTO
    {
        $user = $this->userRepository->create([
            'email' => $dto->email,
            'password' => $dto->password,
            'gender' => $dto->gender,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return new RegisterResponseDTO($token, $this->userTransformer->transform($user));
    }
}
