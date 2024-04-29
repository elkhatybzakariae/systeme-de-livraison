<?php

namespace App\Helpers;
use App\Models\Role;
use App\Models\Tarif;
use App\Models\User;
use App\Models\Zone;
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
    public static function generateIdZ()
    {
        $id_Z = Str::random(15);
        while (Zone::where('id_Z', $id_Z)->exists()) {
            $id_Z = Str::random(15);
        }
        return $id_Z;
    }
    public static function generateIdTar()
    {
        $id_Tar = Str::random(15);
        while (Tarif::where('id_Tar', $id_Tar)->exists()) {
            $id_Tar = Str::random(15);
        }
        return $id_Tar;
    }
}
