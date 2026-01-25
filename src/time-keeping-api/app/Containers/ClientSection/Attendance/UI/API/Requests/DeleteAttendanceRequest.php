<?php

namespace App\Containers\ClientSection\Attendance\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

final class DeleteAttendanceRequest extends ParentRequest
{
    protected array $decode = [
        'id',
    ];

    public function rules(): array
    {
        return [];
    }
}
