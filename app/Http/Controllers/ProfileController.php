<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function overview(){
        $admin=Admin::find(session('user')['id_Ad']);

        return view('pages.admin.profile.overview',compact('admin'));
    }
}
