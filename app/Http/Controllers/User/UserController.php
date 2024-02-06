<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $users = User::query()->select()->where('id', '<>', Auth()->user()->id)->orderBy('activated')->get();
        $confirmEachNewRegisteredUser = Settings::query()->find(1)->value('confirm_each_new_registered_user');

        if ($request->ajax()) {
            
            User::query()->find($request->user_id)->update([
                $request->name => $request->result,
            ]);

        }

        return view('user.index', [
            'users' => $users,
            'confirmEachNewRegisteredUser' => $confirmEachNewRegisteredUser,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $confirmEachNewRegisteredUser = Settings::query()->find(1)->value('confirm_each_new_registered_user');

        return view('user.create', [
            'confirmEachNewRegisteredUser' => $confirmEachNewRegisteredUser,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
