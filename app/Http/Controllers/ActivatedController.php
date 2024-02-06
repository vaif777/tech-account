<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ActivatedController extends Controller
{
    public function index()
    {
        if (!Settings::query()->find(1)->value('confirm_each_new_registered_user')){

            return redirect()->route('home');

        }

        if (Settings::query()->find(1)->value('confirm_each_new_registered_user') and Auth()->user()->activated) { 

            return redirect()->route('home');

        }

        return view('auth.activated');
    }
}
