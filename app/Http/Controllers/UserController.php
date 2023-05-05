<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        //

        $roles = Role::all();
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        ////
        ///
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'email_verified_at' => now(),
            'password' => 'sometimes|required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|',
            'status' => 'required|in:active,disabled',

        ]);

        $user = new User($request->input());
        $user->save();
        return redirect('user');
    }

    public function show($id)
    {
        //
        $user = User::find($id);
        return view('user.editUser', compact('user'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);
        $user->fill($request->input())->saveOrFail();
        return redirect('user');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'El usuario ha sido eliminado exitosamente.');
    }
}
