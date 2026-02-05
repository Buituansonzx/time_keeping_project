<?php

namespace App\Containers\SharedSection\Attendance\Models;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Models\Model as ParentModel;

final class DailyWorkSummary extends ParentModel
{
    protected $table = 'daily_work_summaries';

    protected $guarded = [];

    CONST STATUS_NORMAL = 'normal';
    CONST STATUS_ABSENT = 'absent';
    CONST STATUS_LATE = 'late';
    CONST STATUS_LEAVE = 'leave';
    CONST STATUS_EARLY_LEAVE = 'early_leave';
    CONST STATUS_LATE_EARLY = 'late_early';


    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
