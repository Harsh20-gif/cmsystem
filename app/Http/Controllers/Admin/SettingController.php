<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settingsRaw = Setting::all();
        $settings = [];
        
        foreach($settingsRaw as $setting) {
            $settings[$setting->key] = $setting->value;
        }
        
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $keys = [
            'site_name', 'site_email', 'site_phone', 'site_address',
            'facebook_url', 'twitter_url', 'instagram_url', 'linkedin_url', 'youtube_url',
            'site_logo', 'site_favicon', 'google_analytics_id', 'maintenance_mode'
        ];
        
        foreach ($keys as $key) {
            $value = $request->input($key);
            
            // Handle checkboxes like maintenance_mode
            if ($key === 'maintenance_mode') {
                $value = $request->has($key) ? '1' : '0';
            }
            
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
