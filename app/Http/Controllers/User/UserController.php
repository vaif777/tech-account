<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\User\AddUser;
use App\Mail\User\MassRegister;
use App\Models\Settings;
use App\Models\TemporaryDataForRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
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
        $settings = Settings::query()->find(1);
        $confirmEachNewRegisteredUser = $settings->confirm_each_new_registered_user;
        $massAdditionByMail = $settings->mass_addition_by_mail;

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
            'massAdditionByMail' => $massAdditionByMail,
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
        unset($data['name'], $data['email'], $data['activated_user']);
        $password = Str::random(10);

        if (Settings::query()->find(1)->value('confirm_each_new_registered_user')) {
            $activated_user = isset($request->activated_user) ? 1 : 0;
        } else {
            $activated_user = 1;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => NOW(),
            'password' => Hash::make($password),
            'activated' => $activated_user,
        ]);

        $user->permissions()->create($data);
        Mail::to($request->email)->send(new AddUser($password, $request->email));

        return redirect()->route('user.create')->with('success', "Ползователь $request->name добавлен. Пароль: $password");
    }

    public function massCreate()
    {
        $confirmEachNewRegisteredUser = Settings::query()->find(1)->value('confirm_each_new_registered_user');

        return view('user.massCreate', [
            'confirmEachNewRegisteredUser' => $confirmEachNewRegisteredUser,
        ]);
    }

    public function massStore(Request $request)
    {

        $data = explode(",", strip_tags(str_replace(' ', '',preg_replace('/\r\n|\r|\n/u ', '',$request->email))));
        $email = [];
        
        foreach ($data as $v) {
            $email[]['email'] =  $v;
        }

        $validator = Validator::make($email, [
            '*.email' => 'required|string|email|max:255|unique:users',
        ])->validate();


        $data = $request->all();
        unset($data['email']);

        foreach ($email as $v) {

            $data['email'] = $v['email'];

            if (Settings::query()->find(1)->value('confirm_each_new_registered_user')) {
                $activated_user = isset($request->activated_user) ? 1 : 0;
            } else {
                $activated_user = 1;
            }

            $data['activated_user'] = $activated_user;
    
            $tmpUser = TemporaryDataForRegistration::create($data);
            Mail::to($data['email'])->send(new MassRegister($tmpUser->id, $data['email']));  
            
        }

        return redirect()->route('user.mass_create')->with('success', "Ползователи добавлены.");
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
