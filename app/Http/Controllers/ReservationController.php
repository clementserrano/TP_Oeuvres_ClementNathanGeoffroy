<?php

namespace App\Http\Controllers;

use App\modeles\Adherent;
use App\modeles\Reservation;
use App\modeles\Oeuvre;

use Request;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{
    public function getReservations()
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        $reservation = new Reservation();
        $reservations = $reservation->getReservations();
        return view('listeReservations', compact('reservations', 'erreur'));
    }

    public function reserveOeuvre($id, $erreur = "")
    {
        $lOeuvre = new Oeuvre();
        $oeuvre = $lOeuvre->getOeuvre($id);
        $adherent = new Adherent();
        $adherents = $adherent->getAdherents();
        $titreVue = "Réservation d'une Oeuvre";
        return view('formReservation', compact('oeuvre', 'adherents', 'titreVue', 'erreur'));
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
        } catch (Exception $ex) {
            $erreur = $ex->getMessage();
            return $this->reserveOeuvre($id_oeuvre, $erreur);
        }

        return redirect('/listerReservations');
    }

    public function confirmReservation($date, $id, $erreur = "")
    {
        $reservation = new Reservation();

        try {
            $reservation->confirmReservation($date, $id);
        } catch (Exception $ex) {
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
        } catch (Exception $ex) {
            $erreur = $ex->getMessage();
            return $this->deleteReservation($date, $id, $erreur);
        }

        return redirect('/listerReservations');
    }
}
