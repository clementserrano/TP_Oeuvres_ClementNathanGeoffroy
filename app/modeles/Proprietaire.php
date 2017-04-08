<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use DB;

class Proprietaire extends Model
{
    public function login($login, $pwd) {
        $connected =false;
        $proprietaire = DB::table('proprietaire')
            ->select()
            ->where('login','=',$login)
            ->first();
        if ($proprietaire){
            if ($proprietaire->pwd == $pwd) {
                Session::put('id', $proprietaire->id_proprietaire);
                $connected = true;
            }
        }
        return $connected;
    }

    public function logout(){
        Session::forget('id');
    }

    public function getProprietaires()
    {
        $proprietaires = DB::table('proprietaire')
            ->select('id_proprietaire', 'nom_proprietaire', 'prenom_proprietaire')
            ->get();
        return $proprietaires;
    }
}
