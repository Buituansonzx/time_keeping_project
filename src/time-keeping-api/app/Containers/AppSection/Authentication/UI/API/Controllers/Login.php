<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\LoginAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginRequest;
use App\Ship\Parents\Controllers\ApiController;

final class Login extends ApiController
{
    public function login(LoginRequest $request, LoginAction $action)
    {
        $fingerprint = $request->header('X-Device-Fingerprint', null);
        $data = $request->validated();

        $token = $action->run($data,$fingerprint);
        return response()->json( ['data' => $token] );
    }

    public function test()
    {
        return response()->json( ['data' => 'pong'] );
    }
}
