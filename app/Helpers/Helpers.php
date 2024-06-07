<?php

namespace App\Helpers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Colis;
use App\Models\DemandeModificationColi;
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
    public static function generateIdDMC()
    {
        $id_DMC = Str::random(15);
        while (DemandeModificationColi::where('id_DMC', $id_DMC)->exists()) {
            $id_DMC = Str::random(15);
        }
        return $id_DMC;
    }
    public static function applyDateFilter($query, $request,$table='')
{
    if ($request->has('date_filter')) {
        switch ($request->date_filter) {
            case 'today':
                $query->whereDate($table.'created_at', today());
                break;
            case 'yesterday':
                $query->whereDate($table.'created_at', today()->subDay());
                break;
            case 'last_7_days':
                $query->whereBetween($table.'created_at', [now()->subDays(7), now()]);
                break;
            case 'last_30_days':
                $query->whereBetween($table.'created_at', [now()->subDays(30), now()]);
                break;
            case 'this_month':
                $query->whereMonth($table.'created_at', now()->month)
                      ->whereYear($table.'created_at', now()->year);
                break;
            case 'last_month':
                $query->whereMonth($table.'created_at', now()->subMonth()->month)
                      ->whereYear($table.'created_at', now()->subMonth()->year);
                break;
            case 'custom_range':
                if ($request->has('start_date') && $request->has('end_date')) {
                    $query->whereBetween($table.'created_at', [$request->start_date, $request->end_date]);
                }
                break;
        }
    }
    return $query;
}
public static function base64Image($path = 'storage/images/l.png')
    {
        // Check if the file exists
        if (!file_exists(public_path($path))) {
            return null; // or handle the error as needed
        }

        // Get the file type and contents
        $type = pathinfo(public_path($path), PATHINFO_EXTENSION);
        $data = file_get_contents(public_path($path));
        
        // Encode the file contents to base64
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        
        return $base64;
    }
}
