<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use App\DTO\User\RegisterDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $dto = new RegisterDTO($request->validated());
        $responseDTO = $this->userService->register($dto);
        return response()->json($responseDTO, 201);
    }

    public function profile(): JsonResponse
    {
        return response()->json(Auth::user());
    }
}
