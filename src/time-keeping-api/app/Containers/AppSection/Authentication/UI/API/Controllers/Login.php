<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\LoginAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginRequest;
use App\Ship\Parents\Controllers\ApiController;

final class Login extends ApiController
{
    public function login(LoginRequest $request, LoginAction $action)
    {
        $data = $request->validated();

        $token = $action->run($data);
        return response()->json( ['data' => $token] );
    }
}
