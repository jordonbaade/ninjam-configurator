<?php

return [
    'path' => env('NINJAM_CONFIG_PATH', ''),
    'commands' => [
        'status' => env('NINJAM_COMMANDS_STATUS', ''),
        'start' => env('NINJAM_COMMANDS_START', ''),
        'restart' => env('NINJAM_COMMANDS_RESTART', ''),
        'stop' => env('NINJAM_COMMANDS_STOP', '')
    ]
];
