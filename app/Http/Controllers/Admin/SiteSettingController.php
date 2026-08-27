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

    public function contact()
    {
        $settings = SiteSetting::pluck('setting_value', 'setting_key')->toArray();
        return view('admin.settings.contact', compact('settings'));
    }

    public function updateContact(Request $request)
    {
        $data = $request->except(['_token']);

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Contact page settings updated successfully!');
    }

    public function footer()
    {
        $settings = SiteSetting::pluck('setting_value', 'setting_key')->toArray();
        $footerLinks = \App\Models\FooterLink::orderBy('order_position')->get();
        return view('admin.settings.footer', compact('settings', 'footerLinks'));
    }

    public function updateFooter(Request $request)
    {
        $data = $request->except(['_token', 'footer_logo', 'quick_links']);

        // Handle image upload
        if ($request->hasFile('footer_logo')) {
            $path = $request->file('footer_logo')->store('settings', 'public');
            $data['footer_logo'] = $path;
        }

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $value]
            );
        }

        // Handle quick links
        $quickLinks = $request->input('quick_links', []);
        $keepIds = [];
        
        foreach ($quickLinks as $index => $linkData) {
            if (empty($linkData['label']) || empty($linkData['url'])) continue;
            
            $link = \App\Models\FooterLink::updateOrCreate(
                ['id' => $linkData['id'] ?? null],
                [
                    'label' => $linkData['label'],
                    'url' => $linkData['url'],
                    'order_position' => $index, // Save based on array order
                    'status' => $linkData['status'] ?? 'published'
                ]
            );
            $keepIds[] = $link->id;
        }
        
        // Remove deleted links
        \App\Models\FooterLink::whereNotIn('id', $keepIds)->delete();

        return redirect()->back()->with('success', 'Footer settings updated successfully!');
    }

    public function about()
    {
        $settings = SiteSetting::pluck('setting_value', 'setting_key')->toArray();
        $features = \App\Models\AboutFeature::orderBy('order_position')->get();
        $facilityCards = \App\Models\AboutFacilityCard::orderBy('order_position')->get();
        return view('admin.settings.about', compact('settings', 'features', 'facilityCards'));
    }

    public function updateAbout(Request $request)
    {
        $data = $request->except(['_token', 'about_intro_image', 'about_hero_bg', 'features', 'facility_cards']);

        // Handle image uploads
        if ($request->hasFile('about_intro_image')) {
            $path = $request->file('about_intro_image')->store('settings', 'public');
            $data['about_intro_image'] = $path;
        }
        if ($request->hasFile('about_hero_bg')) {
            $path = $request->file('about_hero_bg')->store('settings', 'public');
            $data['about_hero_bg'] = $path;
        }

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $value]
            );
        }

        // Handle features
        $features = $request->input('features', []);
        $keepFeatureIds = [];
        
        foreach ($features as $index => $item) {
            if (empty($item['title'])) continue;
            
            $feature = \App\Models\AboutFeature::updateOrCreate(
                ['id' => $item['id'] ?? null],
                [
                    'title' => $item['title'],
                    'icon_class' => $item['icon_class'] ?? 'fas fa-check-circle',
                    'order_position' => $index,
                    'status' => $item['status'] ?? 'published'
                ]
            );
            $keepFeatureIds[] = $feature->id;
        }
        \App\Models\AboutFeature::whereNotIn('id', $keepFeatureIds)->delete();

        // Handle facility cards
        $facilityCards = $request->input('facility_cards', []);
        $keepCardIds = [];
        
        foreach ($facilityCards as $index => $item) {
            if (empty($item['title'])) continue;
            
            $card = \App\Models\AboutFacilityCard::updateOrCreate(
                ['id' => $item['id'] ?? null],
                [
                    'icon_type' => $item['icon_type'] ?? 'font',
                    'icon_class' => $item['icon_class'],
                    'color_class' => $item['color_class'] ?? 'navy',
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'order_position' => $index,
                    'status' => $item['status'] ?? 'published'
                ]
            );
            $keepCardIds[] = $card->id;
        }
        \App\Models\AboutFacilityCard::whereNotIn('id', $keepCardIds)->delete();

        return redirect()->back()->with('success', 'About page settings updated successfully!');
    }
}
