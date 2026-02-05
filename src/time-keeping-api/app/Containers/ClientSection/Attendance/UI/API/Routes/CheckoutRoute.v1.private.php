<?php

/**
 * @apiGroup           Attendance
 * @apiName
 *
 * @api                {POST} /v1/checkout Checkout
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

use App\Containers\ClientSection\Attendance\UI\API\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::post('checkout', [AttendanceController::class, 'checkout'])
    ->middleware(['auth:api', 'check_company_ip']);

