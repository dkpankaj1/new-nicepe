<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\Models\BrandSetting;
use App\Models\Currency;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use App\Services\ToasterService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function brandSetting()
    {
        return view('admin.settings.brand', [
            'brandSetting' => BrandSetting::first()
        ]);
    }
    public function brandSettingUpdate(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "title" => "required|string|max:255",
            "description" => "nullable|string",
            "logo" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
            "logo_light" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
            "logo_dark" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
            "favicon" => "nullable|image|mimes:png|max:512",
            "contact_email" => "nullable|email|max:255",
            "contact_phone" => "nullable|string|max:20",
        ]);


        try {

            $brandSetting = BrandSetting::first();
            $fileUploader = new FileUploader();

            if ($request->hasFile('logo')) {
                $fileUploader->deleteFile($brandSetting->getRawOriginal('logo'));
                $brandSetting->logo = $fileUploader
                    ->setDirectory('static')
                    ->setHeight(94)
                    ->setWidth(99)
                    ->uploadImage($request->file('logo'));
            }

            if ($request->hasFile('logo_light')) {
                $fileUploader->deleteFile($brandSetting->getRawOriginal('logo_light'));
                $brandSetting->logo_light = $fileUploader
                    ->setDirectory('static')
                    ->setHeight(68)
                    ->setWidth(244)
                    ->uploadImage($request->file('logo_light'));
            }

            if ($request->hasFile('logo_dark')) {
                $fileUploader->deleteFile($brandSetting->getRawOriginal('logo_dark'));
                $brandSetting->logo_dark = $fileUploader
                    ->setDirectory('static')
                    ->setHeight(68)
                    ->setWidth(244)
                    ->uploadImage($request->file('logo_dark'));
            }

            if ($request->hasFile('favicon')) {
                $fileUploader->deleteFile($brandSetting->getRawOriginal('favicon'));
                $brandSetting->favicon = $fileUploader
                    ->setDirectory('static')
                    ->setHeight(32)
                    ->setWidth(32)
                    ->uploadImage($request->file('favicon'));
            }

            $brandSetting->name = $request->name;
            $brandSetting->title = $request->title;
            $brandSetting->description = $request->description;
            $brandSetting->contact_email = $request->contact_email;
            $brandSetting->contact_phone = $request->contact_phone;
            $brandSetting->save();

            ToasterService::success('Update Success.');
            return redirect()->back();
        } catch (\Exception $e) {
            ToasterService::error('Something went wrong.');
            return redirect()->back();
        }
    }
    public function generalSetting()
    {
        return view('admin.settings.general', [
            'currencies' => Currency::all(),
            'generalSetting' => GeneralSetting::first()
        ]);
    }
    public function generalSettingUpdate(Request $request)
    {
        $request->validate([
            "date_format" => "required|string|in:Y-m-d,m/d/Y,d-m-Y",
            "default_currency" => ["required", Rule::exists(Currency::class, 'id')],
            "timezone" => "required|timezone",
            "language" => "required|string|max:5|in:en,hi",
            "session_timeout" => "required|integer|min:1|max:1440",
            "editor_key" => "nullable|string|max:255",
            "copyright" => "nullable|string|max:255",
            "developed_by" => "nullable|string|max:255",
        ]);
        try {

            $generalSetting = GeneralSetting::first();

            $generalSetting->date_format = $request->date_format;
            $generalSetting->default_currency = $request->default_currency;
            $generalSetting->timezone = $request->timezone;
            $generalSetting->language = $request->language;
            $generalSetting->session_timeout = $request->session_timeout;
            $generalSetting->copyright = $request->copyright;
            $generalSetting->developed_by = $request->developed_by;

            $generalSetting->save();

            ToasterService::success('Update Success.');
            return redirect()->back();
        } catch (\Exception $e) {
            ToasterService::error('Something went wrong.');
            return redirect()->back();
        }
    }
    public function emailConfigrution()
    {
        return view(
            'admin.settings.email',
            ['emailConfig' => EmailConfiguration::first()]
        );
    }
    public function emailConfigrutionUpdate(Request $request)
    {
        $request->validate([
            "smtp_host" => "required|string|max:255",
            "smtp_port" => "required|integer|min:1|max:65535",
            "smtp_username" => "nullable|string|max:255",
            "smtp_password" => "nullable|string|max:255",
            "smtp_encryption" => "nullable|string|in:tls,ssl",
            "from_address" => "required|email|max:255",
            "from_name" => "required|string|max:255",
            "reply_to_address" => "nullable|email|max:255",
            "reply_to_name" => "nullable|string|max:255",
            "enable" => "required|boolean",
        ]);

        try {

            $emailConfigurationSetting = EmailConfiguration::first();

            $emailConfigurationSetting->smtp_host = $request->smtp_host;
            $emailConfigurationSetting->smtp_port = $request->smtp_port;
            $emailConfigurationSetting->smtp_username = $request->smtp_username;
            $emailConfigurationSetting->smtp_password = $request->smtp_password;
            $emailConfigurationSetting->smtp_encryption = $request->smtp_encryption;
            $emailConfigurationSetting->from_address = $request->from_address;
            $emailConfigurationSetting->from_name = $request->from_name;
            $emailConfigurationSetting->reply_to_address = $request->reply_to_address;
            $emailConfigurationSetting->reply_to_name = $request->reply_to_name;
            $emailConfigurationSetting->enable = $request->enable;

            $emailConfigurationSetting->save();

            ToasterService::success('Update Success.');
            return redirect()->back();
        } catch (\Exception $e) {
            ToasterService::error('Something went wrong.');
            return redirect()->back();
        }
    }
}
