<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Task;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->sortBy('name');
        return view('user.index', ['users' => $users]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $tasks = Task::all();
        return view('user.show', ['user' => $user, 'tasks' => $tasks]);
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
       $user -> isAdmin = $request -> user_isAdmin;
       $user->save();
       return redirect()->route('user.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->userTasks->count()){
            return redirect()->route('user.index')->with('info_message', 'Trinti negalima, nes turi priskirtų darbų');
        } elseif($user->isAdmin){
            return redirect()->route('user.index')->with('info_message', 'Trinti administratoriaus negalima, pirma pakeiskite statusą');
        }
        $user->delete();
        return redirect()->route('user.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}
