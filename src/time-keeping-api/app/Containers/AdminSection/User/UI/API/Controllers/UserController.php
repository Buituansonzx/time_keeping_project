<?php

namespace App\Containers\AdminSection\User\UI\API\Controllers;

use App\Containers\AdminSection\User\Actions\CreateUserAction;
use App\Containers\AdminSection\User\Actions\UpdateUserAction;
use App\Containers\AdminSection\User\UI\API\Requests\CreateUserRequest;
use App\Containers\AdminSection\User\UI\API\Requests\UpdateUserRequest;
use App\Ship\Parents\Controllers\ApiController;

final class UserController extends ApiController
{
    public function create(CreateUserRequest $request, CreateUserAction $action)
    {
        $user = $action->run($request->validated());
        return response()->json( ['data' => $user] );
    }

    public function update(UpdateUserRequest $request, UpdateUserAction $action)
    {
        $user = $action->run($request->id, $request->validated());
        return response()->json( ['data' => $user] );
    }
}
