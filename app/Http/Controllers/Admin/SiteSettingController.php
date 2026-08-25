<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function home()
    {
        $settings = SiteSetting::pluck('setting_value', 'setting_key')->toArray();
        return view('admin.settings.home', compact('settings'));
    }

    public function updateHome(Request $request)
    {
        $data = $request->except(['_token', 'hero_image']);

        // Handle image upload
        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('settings', 'public');
            $data['home_hero_image'] = $path;
        }

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Home page settings updated successfully!');
    }
}
