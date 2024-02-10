<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TemporaryDataForRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationInvitationController extends Controller
{
    public function formRegistr($id, $mail)
    {
        return view('auth.registrInvitation', [
            'id' => $id,
            'mail' => $mail,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $tmpUser = TemporaryDataForRegistration::query()->select(["add", "edit", "delete", "activated", 'to_activate', 'network_infrastructure', 'telephone_infrastructure', "storage", 'facilities', 'reference', "user", "setting"])->where(['id' => $request->id, 'email' => $request->email])->first()->toArray();
        $data = $request->all();
        $data["activated"] = $tmpUser["activated"];
        unset($data['id'], $tmpUser['activated']);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'email_verified_at' => NOW(),
            'password' => Hash::make($data['password']),
            'activated' => $data['activated'],
        ]);

        $user->permissions()->create($tmpUser);

        TemporaryDataForRegistration::query()->find($request->id)->delete();


        return redirect()->route('home');
    }
}
