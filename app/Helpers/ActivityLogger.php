<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    /**
     * Log an activity to the activity log.
     *
     * @param string $action The action performed (e.g., 'create', 'update')
     * @param string|null $module The module or context of the action (optional)
     * @param string|null $description A description of the action (optional)
     * @param array $requestData Additional request data to log (optional)
     * @return bool
     */
    public static function log(
        string $action,
        ?string $module = null,
        ?string $description = null,
        array $requestData = []
    ): bool {
        try {
            $ipAddress = Request::ip();
            // Validate IP address
            if (!filter_var($ipAddress, FILTER_VALIDATE_IP)) {
                $ipAddress = null; // Or handle invalid IP as needed
            }

            ActivityLog::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'action' => $action,
                'module' => $module,
                'description' => $description,
                'ip_address' => $ipAddress,
                'request_data' => !empty($requestData) ? json_encode($requestData) : null,
            ]);

            return true;
        } catch (\Exception $e) {
            // Log the error to a file or monitoring system if needed
            Log::error('ActivityLogger failed: ' . $e->getMessage());
            return false;
        }
    }
}