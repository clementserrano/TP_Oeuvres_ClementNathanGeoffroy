<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use DB;
use Mockery\Exception;

class Oeuvre extends Model
{
    public function getOeuvres()
    {
        $oeuvres = DB::table('oeuvre')
            ->select('id_oeuvre', 'proprietaire.prenom_proprietaire', 'proprietaire.nom_proprietaire', 'titre', 'prix')
            ->join('proprietaire', 'oeuvre.id_proprietaire', '=', 'proprietaire.id_proprietaire')
            ->get();
        return $oeuvres;
    }

    public function getOeuvre($idOeuvre)
    {
        $oeuvre = DB::table('oeuvre')
            ->select()
            ->where('id_oeuvre', '=', $idOeuvre)
            ->first();
        return $oeuvre;
    }

    public function updateOeuvre($id_oeuvre, $id_proprietaire, $titre, $prix)
    {
        try {
            DB::table('oeuvre')
                ->where('id_oeuvre', '=', $id_oeuvre)
                ->update(['id_proprietaire' => $id_proprietaire, 'titre' => $titre, 'prix' => $prix]);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function insertOeuvre($id_proprietaire, $titre, $prix)
    {
        $cle = DB::table('cles')->select('val_cle')->where('id_cle','=','OEUVRE')->first();
        $id_oeuvre=$cle->val_cle+1;

        try {
            DB::table('oeuvre')
                ->insert(['id_oeuvre' => $id_oeuvre, 'id_proprietaire' => $id_proprietaire, 'titre' => $titre, 'prix' => $prix]);
            DB::table('cles')->where('id_cle','=','OEUVRE')->update(['val_cle' => $id_oeuvre]);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function deleteOeuvre($id_oeuvre)
    {
        try {
            DB::table('oeuvre')
                ->where('id_oeuvre', '=', $id_oeuvre)
                ->delete();
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
