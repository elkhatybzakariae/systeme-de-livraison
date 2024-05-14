<?php

namespace App\Helpers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Colis;
use App\Models\Depense;
use App\Models\Livreur;
use App\Models\Message;
use App\Models\Ramassagecoli;
use App\Models\Reclamation;
use App\Models\Remarque;
use App\Models\Role;
use App\Models\Tarif;
use App\Models\Zone;
use Illuminate\Support\Str;
class Helpers
{
    public static function generateIdAd()
    {
        $id_Ad = Str::random(15);
        while (Admin::where('id_Ad', $id_Ad)->exists()) {
            $id_Ad = Str::random(15);
        }
        return $id_Ad;
    }
    public static function generateIdCl()
    {
        $id_Cl = Str::random(15);
        while (Client::where('id_Cl', $id_Cl)->exists()) {
            $id_Cl = Str::random(15);
        }
        return $id_Cl;
    }
    public static function generateIdLiv()
    {
        $id_Liv = Str::random(15);
        while (Livreur::where('id_Liv', $id_Liv)->exists()) {
            $id_Liv = Str::random(15);
        }
        return $id_Liv;
    }
    // public static function generateIdRole()
    // {
    //     $id_R = Str::random(15);
    //     while (Role::where('id_R', $id_R)->exists()) {
    //         $id_R = Str::random(15);
    //     }
    //     return $id_R;
    // }
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
    public static function generateIdDep()
    {
        $id_Dep = Str::random(15);
        while (Depense::where('id_Dep', $id_Dep)->exists()) {
            $id_Dep = Str::random(15);
        }
        return $id_Dep;
    }
    public static function generateIdC()
    {
        $idC = Str::random(15);
        while (Colis::where('id', $idC)->exists()) {
            $idC = Str::random(15);
        }
        return $idC;
    }
    
    public static function generateIdRec()
    {
        $id_Rec = Str::random(15);
        while (Reclamation::where('id_Rec', $id_Rec)->exists()) {
            $id_Rec = Str::random(15);
        }
        return $id_Rec;
    }
    public static function generateIdRam()
    {
        $id_Ram = Str::random(15);
        while (Ramassagecoli::where('id_Ram', $id_Ram)->exists()) {
            $id_Ram = Str::random(15);
        }
        return $id_Ram;
    }
    public static function generateIdRem()
    {
        $id_Rem = Str::random(15);
        while (Remarque::where('id_Rem', $id_Rem)->exists()) {
            $id_Rem = Str::random(15);
        }
        return $id_Rem;
    }
    public static function generateIdMess()
    {
        $id_Mess = Str::random(15);
        while (Message::where('id_Mess', $id_Mess)->exists()) {
            $id_Mess = Str::random(15);
        }
        return $id_Mess;
    }
}
