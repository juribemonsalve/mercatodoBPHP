<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class UserController extends controller
{
    public function index(Request $request): View
    {
        //

        $roles = Role::all();
        $search = $request->search;
        $users = User::where('full_name', 'LIKE', '%' . $search . '%')
            ->orWhere('status', 'LIKE', '%' . $search . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);
        $data = ['users' => $users, 'search' => $search];
        return view('user.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(UserRequest $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id): View
    {
        //
        $user = User::findOrFail($id);
        return view('user.edit_user', compact('user'));
    }

    public function update(UserRequest $request, $id): RedirectResponse
    {
        $user = User::find($id);
        $user->fill($request->input())->saveOrFail();
        return redirect('user');
    }

    public function destroy($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'El usuario ha sido eliminado exitosamente.');
    }
}
