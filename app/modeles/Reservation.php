<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use DB;

class Reservation extends Model
{
    public function getReservations()
    {
        $oeuvres = DB::table('reservation')
            ->select('date_reservation', 'oeuvre.id_oeuvre', 'oeuvre.titre', 'statut', 'adherent.prenom_adherent', 'adherent.nom_adherent')
            ->join('oeuvre', 'reservation.id_oeuvre', '=', 'oeuvre.id_oeuvre')
            ->join('adherent', 'reservation.id_adherent', '=', 'adherent.id_adherent')
            ->get();
        return $oeuvres;
    }

    public function getReservation($id_reservation)
    {
        $reservation = DB::table('reservation')
            ->select()
            ->where('id_reservation', '=', $id_reservation)
            ->first();
        return $reservation;
    }

    public function reserveOeuvre($date_reservation, $id_oeuvre, $id_adherent){
        try {
            DB::table('reservation')
                ->insert(['date_reservation' => $date_reservation, 'id_oeuvre' => $id_oeuvre, 'id_adherent' => $id_adherent, 'statut' => 'Attente']);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function confirmReservation($date_reservation, $id_oeuvre){
        try {
            DB::table('reservation')
                ->where([
                    ['date_reservation', '=', $date_reservation],
                    ['id_oeuvre', '=', $id_oeuvre],
                ])
                ->update(['statut' => 'Confirmée']);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public function deleteReservation($date_reservation, $id_oeuvre){
        try {
            DB::table('reservation')
                ->where([
                    ['date_reservation', '=', $date_reservation],
                    ['id_oeuvre', '=', $id_oeuvre],
                ])
                ->delete();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
