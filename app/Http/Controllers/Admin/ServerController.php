<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ToasterService;
use App\Traits\AuthorizationFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ServerController extends Controller
{
    use AuthorizationFilter;
    public function __construct()
    {
        $this->isSuperAdmin();
    }
    public function command()
    {
        return view('admin.server.command');
    }
    public function commandExecute(Request $request)
    {
        $request->validate([
            'command' => 'required|string'
        ]);
        
        try {

            Artisan::call($request->command);
            ToasterService::success(__('message.success.default'));
            return redirect()->back();

        } catch (\Exception $e) {
            ToasterService::error(__('message.error.default'));
            return redirect()->back();
        }
    }
}
