<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $settings = Settings::query()->find(1);

        if ($request->ajax()) {
            
            $settings->update([
                $request->name => $request->result,
            ]);

            return [ $request->name => $request->result];
        }

        return view('settings.index', [
            'settings' => $settings,
        ]);

       
    }
}
