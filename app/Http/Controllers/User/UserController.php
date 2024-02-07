<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\User\AddUser;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('add')->only(['create', 'store']);
        $this->middleware('edit')->only(['edit', 'update']);
        $this->middleware('delite')->only(['destroy']);
       
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $users = User::query()->select()->where('id', '<>', Auth()->user()->id)->orderBy('activated')->get();
        $confirmEachNewRegisteredUser = Settings::query()->find(1)->value('confirm_each_new_registered_user');

        if ($request->ajax()) {

            if (Auth()->user()->permissions->activated) {

                User::query()->find($request->user_id)->update([
                    $request->name => $request->result,
                ]);
            }
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $data = $request->all();
        unset($data['name'], $data['email'], $data['activated']);
        $password = Str::random(10);

        if (Settings::query()->find(1)->value('confirm_each_new_registered_user')) {
            $activated = isset($request->activated) ? 1 : 0;
        } else {
            $activated = 1;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => NOW(),
            'password' => Hash::make($password),
            'activated' => $activated,
        ]);

        $user->permissions()->create($data);
        Mail::to($request->email)->send(new AddUser($password, $request->email));

        return redirect()->route('user.create')->with('success', "Ползователь $request->name добавлен. Пароль: $password");
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
