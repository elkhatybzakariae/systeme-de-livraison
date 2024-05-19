<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function overview(){

        return view('pages.admin.profile.overview');
    }
}
