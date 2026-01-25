<?php

namespace App\Containers\AdminSection\Network\UI\API\Controllers;

use App\Containers\AdminSection\Network\Actions\CreateNetworkAction;
use App\Containers\AdminSection\Network\Actions\ListingNetworkAction;
use App\Containers\AdminSection\Network\Actions\UpdateNetworkAction;
use App\Containers\AdminSection\Network\UI\API\Requests\CreateNetworkRequest;
use App\Containers\AdminSection\Network\UI\API\Requests\ListingNetworkRequest;
use App\Containers\AdminSection\Network\UI\API\Requests\UpdateNetworkRequest;
use App\Ship\Parents\Controllers\ApiController;

final class NetworkController extends ApiController
{
    public function create(CreateNetworkRequest $request, CreateNetworkAction $action)
    {
        $data = $request->validated();
        $network = $action->run($data);
        return response()->json( ['data' => $network] );
    }

    public function update(UpdateNetworkRequest $request, UpdateNetworkAction $action)
    {
        $networkId = $request->id;
        $network = $action->run($networkId, $request->validated());
        return response()->json( ['data' => $network] );
    }

    public function index(ListingNetworkRequest $request, ListingNetworkAction $action)
    {
        $networks = $action->run($request->validated());
        return response()->json( ['data' => $networks] );
    }
}
