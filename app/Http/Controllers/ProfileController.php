<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Livreur;
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
    public function overviewClient(){
        $client=Client::find(session('user')['id_Cl']);
        $breads = [
            ['title' => 'Profile Client ', 'url' => null],
            ['text' => 'Profile', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.clients.profile.overview',compact('client','breads'));
    }
    public function overviewLiv(){
        $livreur=Livreur::find(session('user')['id_Liv']);
        $breads = [
            ['title' => 'Profile Livreur ', 'url' => null],
            ['text' => 'Profile', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.livreur.profile.overview',compact('livreur','breads'));
    }
}
