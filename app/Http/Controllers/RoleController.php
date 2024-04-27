<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // public function roleindex()
    // {
    //     $roles = Role::all();
    //     return view('auth.superadmin.roleindex', compact('roles'));
    // }
    // public function rolecreate()
    // {
    //     return view('auth.superadmin.createrole');
    // }
    public function rolestore(Request $request)
    {
        $id = Helpers::generateIdRole();
        $validation = $request->validate([
            'role_name' => 'required|string|max:50',
        ]);
        Role::create([
            'id_R'=> $id,
            'role_name' => $validation['role_name'],
        ]);
        return redirect()->route('roleindex');
    }
    // public function deleterole($id)
    // {
    //     Role::find($id)->delete();
    //     return redirect()->route('roleindex');
    // }
}
