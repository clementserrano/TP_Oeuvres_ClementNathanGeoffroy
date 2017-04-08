<?php

namespace App\Http\Controllers;

use App\modeles\Proprietaire;
use App\modeles\Oeuvre;

use Request;
use Illuminate\Support\Facades\Session;

class OeuvreController extends Controller
{
    public function getOeuvres()
    {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        $oeuvre = new Oeuvre();
        $oeuvres = $oeuvre->getOeuvres();
        return view('listeOeuvres', compact('oeuvres', 'erreur'));
    }

    public function updateOeuvre($id, $erreur = "")
    {
        $lOeuvre = new Oeuvre();
        $oeuvre = $lOeuvre->getOeuvre($id);
        $proprietaire = new Proprietaire();
        $proprietaires = $proprietaire->getProprietaires();
        $titreVue = "Modification d'une Oeuvre";
        return view('formOeuvre', compact('oeuvre', 'proprietaires', 'titreVue', 'erreur'));
    }

    public function validateOeuvre()
    {
        $id_oeuvre = Request::input('id_oeuvre');
        $id_proprietaire = Request::input('cbProprietaire');
        $titre = Request::input('titre');
        $prix = Request::input('prix');
        $oeuvre = new Oeuvre();

        try {
            if ($id_oeuvre > 0) {
                $oeuvre->updateOeuvre($id_oeuvre, $id_proprietaire, $titre, $prix);
            } else {
                $oeuvre->insertOeuvre($id_proprietaire, $titre, $prix);
            }
        } catch (Exception $ex) {
            $erreur = $ex->getMessage();
            if ($id_oeuvre > 0) {
                return $this->updateOeuvre($id_oeuvre, $erreur);
            } else {
                return $this->addOeuvre($erreur);
            }

        }

        return redirect('/listerOeuvres');
    }

    public function addOeuvre($erreur = "")
    {
        $oeuvre = new Oeuvre();
        $proprietaire = new Proprietaire();
        $proprietaires = $proprietaire->getProprietaires();
        $titreVue = "Ajout d'un Proprietaire";
        return view('formOeuvre', compact('oeuvre', 'proprietaires', 'titreVue', 'erreur'));

    }

    public function deleteOeuvre($id, $erreur = '')
    {
        $oeuvre = new Oeuvre();

        try {
            $oeuvre->deleteOeuvre($id);
        } catch (Exception $ex) {
            $erreur = $ex->getMessage();
            return $this->deleteOeuvre($id, $erreur);
        }

        return redirect('/listerOeuvres');
    }
}
