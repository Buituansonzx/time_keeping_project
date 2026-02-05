<?php

return [
    'start' => env('WORK_START', '09:00'),
    'end'   => env('WORK_END', '19:00'),
    'grace_minutes' => (int) env('WORK_GRACE_MINUTES', 10),
];
