<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        return view('backend.settings.index', compact('setting'));
    }

    /**
     * Update or create system settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $setting = Setting::first(); // ✅ Always use the first record

        $data = $request->validate([
            'bname'                 => 'required|string|max:200',
            'email'                 => 'nullable|email|max:200',
            'phone'                 => 'nullable|string|max:20',
            'currency'              => 'nullable|string|max:20',
            'whatsapp'              => 'nullable|string|max:20',
            'address'               => 'nullable|string|max:255',
            'logo'                  => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'meta_title'            => 'nullable|string|max:255',
            'meta_keywords'         => 'nullable|string',
            'meta_description'      => 'nullable|string',
            'social'                => 'nullable',
            'map'                   => 'nullable',
            'header'                => 'nullable',
            'footer'                => 'nullable',
            'other'                 => 'nullable',
        ]);

        // ✅ Handle Logo Upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');

            // Delete old logo if exists
            if ($setting && $setting->logo && file_exists(public_path('uploads/images/logo/' . $setting->logo))) {
                unlink(public_path('uploads/images/logo/' . $setting->logo));
            }

            // Create unique name and move to folder
            $logoName = time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/images/logo/'), $logoName);
            $data['logo'] = $logoName;
        }

        // ✅ Update or Create Settings
        if ($setting) {
            $setting->update($data);
        } else {
            Setting::create($data);
        }

        return redirect()->route('setting')->with('success', 'Settings updated successfully!');
    }
}
