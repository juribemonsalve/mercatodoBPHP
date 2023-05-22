<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //

        $roles = Role::all();
        $search = $request->search;
        $users = User::where('name', 'LIKE', '%' . $search . '%')
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

    public function update(UserRequest $request, $id)
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
