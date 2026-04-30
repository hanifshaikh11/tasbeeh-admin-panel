<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name'       => 'required|string|max:255',
            'page_title'     => 'required|string|max:255',

            'contact_email'  => 'nullable|email|max:255',
            'contact_phone'  => 'nullable|string|max:50',
            'address'        => 'nullable|string',
            'footer_text'    => 'nullable|string|max:255',

            'sidebar_logo'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'favicon'        => 'nullable|image|mimes:jpg,jpeg,png,ico,webp|max:1024',
        ]);

        $fields = [
            'app_name',
            'page_title',
            'contact_email',
            'contact_phone',
            'address',
            'footer_text',
        ];

        foreach ($fields as $field) {
            Setting::updateOrCreate(
                ['key' => $field],
                ['value' => $request->$field]
            );
        }

        // Sidebar Logo Upload
        if ($request->hasFile('sidebar_logo')) {

            $path = $request->file('sidebar_logo')
                ->store('settings', 'public');

            Setting::updateOrCreate(
                ['key' => 'sidebar_logo'],
                ['value' => $path]
            );
        }

        // Favicon Upload
        if ($request->hasFile('favicon')) {

            $path = $request->file('favicon')
                ->store('settings', 'public');

            Setting::updateOrCreate(
                ['key' => 'favicon'],
                ['value' => $path]
            );
        }

        return redirect()
            ->back()
            ->with('success', 'Settings updated successfully.');
    }
}
