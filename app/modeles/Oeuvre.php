<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use DB;

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
        $id_oeuvre = DB::table('oeuvre')->max('id_oeuvre');
        $id_oeuvre++;

        try {
            DB::table('oeuvre')
                ->insert(['id_oeuvre' => $id_oeuvre, 'id_proprietaire' => $id_proprietaire, 'titre' => $titre, 'prix' => $prix]);
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
