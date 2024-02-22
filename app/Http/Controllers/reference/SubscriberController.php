<?php

namespace App\Http\Controllers\reference;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscribers = Subscriber::All();

        return view('reference.subscriber.index', [
            'subscribers' => $subscribers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $departments = Department::all();

        return view('reference.subscriber.create', [
            'departments' => $departments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Subscriber::create($request->all());

        return redirect()->route('subscriber.create')->with('success', 'Запись добавленна');
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
