<?php

namespace App\Helpers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
class Helpers
{
    public static function generateIdU()
    {
        $id_U = Str::random(15);
        while (User::where('id_U', $id_U)->exists()) {
            $id_U = Str::random(15);
        }
        return $id_U;
    }
    public static function generateIdRole()
    {
        $id_R = Str::random(15);
        while (Role::where('id_R', $id_R)->exists()) {
            $id_R = Str::random(15);
        }
        return $id_R;
    }
}
