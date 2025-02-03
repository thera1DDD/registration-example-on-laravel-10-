<?php

namespace App\Transformers;

use App\Models\User;

class UserTransformer
{
    public function transform(User $user): array
    {
        return [
            'id' => $user->id,
            'email' => $user->email,
            'gender' => $user->gender,
        ];
    }
}

