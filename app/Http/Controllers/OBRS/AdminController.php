<?php

namespace App\Http\Controllers\OBRS;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\User;
use DB;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:users');
    }

    public function index() {
        $users = User::all();

        return view('obrs.users.index', compact('users'));
    }

    public function edit($id) {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->first();

        return view('obrs.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id) {
        $user = User::find($id);

        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($request->role);

        return response()->json('success', 200);
    }
}
