<?php

/**
 * @apiGroup           Network
 * @apiName
 *
 * @api                {POST} /v1/admin/network Create
 * @apiDescription     Endpoint description here...
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => '', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} parameters here...
 *
 * @apiSuccessExample  {json} Success-Response:
 * HTTP/1.1 200 OK
 * {
 *     // Insert the response of the request here...
 * }
 */

use App\Containers\AdminSection\Network\UI\API\Controllers\NetworkController;
use Illuminate\Support\Facades\Route;

Route::post('admin/network', [NetworkController::class, 'create'])
    ->middleware(['auth:api', 'role:admin']);

