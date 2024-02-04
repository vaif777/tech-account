<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        //$buildings = Building::query()->select()->get();

        return view('settings.index', [
            //'floors' => $floors,
        ]);

       
    }
}
