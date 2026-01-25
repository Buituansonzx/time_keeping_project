<?php

namespace App\Containers\ClientSection\Attendance\UI\API\Transformers;

use App\Containers\ClientSection\Attendance\Models\Attendance;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

final class AttendanceTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [];

    protected array $availableIncludes = [];

    public function transform(Attendance $attendance): array
    {
        return [
            'type' => $attendance->getResourceKey(),
            'id' => $attendance->getHashedKey(),
            'created_at' => $attendance->created_at,
            'updated_at' => $attendance->updated_at,
            'readable_created_at' => $attendance->created_at->diffForHumans(),
            'readable_updated_at' => $attendance->updated_at->diffForHumans(),
        ];
    }
}
