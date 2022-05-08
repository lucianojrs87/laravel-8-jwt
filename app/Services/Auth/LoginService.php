<?php

namespace App\Services\Auth;
use App\Http\Lib\MessagesApi;

use Exception;

class LoginService
{
    public function execute(array $credentials)
    {
        if(!$token = auth()->setTTL(60*60)->attempt($credentials))
            throw new Exception(MessagesApi::STATUS_CODE_401_UNAUTHORIZED, 401);
            return [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => auth()->factory()->getTTL(),
                'user' => auth()->user(),
            ];
    }
}
