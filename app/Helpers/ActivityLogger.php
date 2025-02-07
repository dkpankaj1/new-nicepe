<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    public static function log(
        string $action,
        string $module = null,
        string $description = null,
        array $requestData = []
    ) {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'ip_address' => Request::ip(),
            'request_data' => $requestData,
        ]);
    }
}
