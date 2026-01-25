<?php

namespace App\Containers\ClientSection\Attendance\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\ClientSection\Attendance\Actions\CreateAttendanceAction;
use App\Containers\ClientSection\Attendance\Actions\DeleteAttendanceAction;
use App\Containers\ClientSection\Attendance\Actions\FindAttendanceByIdAction;
use App\Containers\ClientSection\Attendance\Actions\ListAttendancesAction;
use App\Containers\ClientSection\Attendance\Actions\UpdateAttendanceAction;
use App\Containers\ClientSection\Attendance\UI\API\Requests\CreateAttendanceRequest;
use App\Containers\ClientSection\Attendance\UI\API\Requests\DeleteAttendanceRequest;
use App\Containers\ClientSection\Attendance\UI\API\Requests\FindAttendanceByIdRequest;
use App\Containers\ClientSection\Attendance\UI\API\Requests\ListAttendancesRequest;
use App\Containers\ClientSection\Attendance\UI\API\Requests\UpdateAttendanceRequest;
use App\Containers\ClientSection\Attendance\UI\API\Transformers\AttendanceTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class Controller extends ApiController
{
    public function create(CreateAttendanceRequest $request, CreateAttendanceAction $action): JsonResponse
    {
       $attendance = $action->run($request);

       return Response::create($attendance, AttendanceTransformer::class)->created();
    }

    public function findById(FindAttendanceByIdRequest $request, FindAttendanceByIdAction $action): JsonResponse
    {
        $attendance = $action->run($request);

        return Response::create($attendance, AttendanceTransformer::class)->ok();
    }

    public function list(ListAttendancesRequest $request, ListAttendancesAction $action): JsonResponse
    {
        $attendances = $action->run($request);

        return Response::create($attendances, AttendanceTransformer::class)->ok();
    }

    public function update(UpdateAttendanceRequest $request, UpdateAttendanceAction $action): JsonResponse
    {
        $attendance = $action->run($request);

        return Response::create($attendance, AttendanceTransformer::class)->ok();
    }

    public function delete(DeleteAttendanceRequest $request, DeleteAttendanceAction $action): JsonResponse
    {
        $action->run($request);

        return Response::noContent();
    }
}
