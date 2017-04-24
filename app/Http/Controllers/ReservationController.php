<?php

namespace App\Http\Controllers;

use App\modeles\Adherent;
use App\modeles\Reservation;
use App\modeles\Oeuvre;

use Request;

class ReservationController extends Controller
{
    public function getReservations($erreur = "")
    {
        $reservation = new Reservation();
        $reservations = $reservation->getReservations();
        return view('listeReservations', compact('reservations', 'erreur'));
    }

    public function reserveOeuvre($id, $date_reservation = null, $id_adherent = null, $erreur = "")
    {
        $lOeuvre = new Oeuvre();
        $oeuvre = $lOeuvre->getOeuvre($id);
        $adherent = new Adherent();
        $adherents = $adherent->getAdherents();
        $titreVue = "Réservation d'une Oeuvre";
        return view('formReservation', compact('oeuvre', 'adherents', 'titreVue', 'date_reservation', 'id_adherent', 'erreur'));
    }

    public function validateReservation()
    {
        $date = Request::input('date_reservation');
        $date_reservation = date('Y-m-d', strtotime($date));
        $id_oeuvre = Request::input('id_oeuvre');
        $id_adherent = Request::input('cbAdherent');
        $reservation = new Reservation();

        try {
            $reservation->reserveOeuvre($date_reservation, $id_oeuvre, $id_adherent);
        } catch (\Illuminate\Database\QueryException $ex) {
            $erreur = $ex->getMessage();
            return $this->reserveOeuvre($id_oeuvre, $date, $id_adherent, $erreur);
        }

        return redirect('/listerReservations');
    }

    public function confirmReservation($date, $id, $erreur = "")
    {
        $reservation = new Reservation();

        try {
            $reservation->confirmReservation($date, $id);
        } catch (\Illuminate\Database\QueryException $ex) {
            $erreur = $ex->getMessage();
            return $this->confirmReservation($date, $id, $erreur);
        }

        return redirect('/listerReservations');
    }

    public function deleteReservation($date, $id, $erreur = '')
    {
        $reservation = new Reservation();

        try {
            $reservation->deleteReservation($date, $id);
        } catch (\Illuminate\Database\QueryException $ex) {
            $erreur = $ex->getMessage();
            $this->getReservations($erreur);
        }

        return redirect('/listerReservations');
    }
}
