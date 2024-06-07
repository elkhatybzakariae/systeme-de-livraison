<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function overview(){
        $admin=Admin::find(session('user')['id_Ad']);
        $breads = [
            ['title' => 'Profile Admin ', 'url' => null],
            ['text' => 'Profile', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.admin.profile.overview',compact('admin','breads'));
    }
}
