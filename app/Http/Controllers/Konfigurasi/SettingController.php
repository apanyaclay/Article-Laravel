<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('setting.index', [
            'title' => 'Setting',
        ]);
    }
    public function update(Request $request)
    {
        $settings = $request->except('_token');
        foreach ($settings as $key => $value) {
            if ($request->hasFile($key)) {
                // Handle file upload
                $file = $request->file($key);
                $path = $file->store('logos', 'public');

                // Update setting with file path
                Setting::where('key', $key)->update(['value' => $path]);
            } else {
                // Update setting with text value
                Setting::where('key', $key)->update(['value' => $value]);
            }
        }
        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
