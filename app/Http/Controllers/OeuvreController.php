<?php

namespace App\Http\Controllers;

use App\modeles\Proprietaire;
use App\modeles\Oeuvre;

use Request;

class OeuvreController extends Controller
{
    public function getOeuvres($erreur = "")
    {
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
        } catch (\Illuminate\Database\QueryException $ex) {
            $erreur = $ex->getMessage();
            if ($id_oeuvre > 0) {
                return $this->updateOeuvre($id_oeuvre, $erreur);
            } else {
                return $this->addOeuvre($id_proprietaire,$titre,$prix,$erreur);
            }

        }

        return redirect('/listerOeuvres');
    }

    public function addOeuvre($id_proprietaire = null,$titre = "",$prix = 0,$erreur = "")
    {
        $oeuvre = new Oeuvre();
        $oeuvre->id_proprietaire = $id_proprietaire;
        $oeuvre->titre = $titre;
        $oeuvre->prix = $prix;
        $proprietaire = new Proprietaire();
        $proprietaires = $proprietaire->getProprietaires();
        $titreVue = "Ajout d'un Proprietaire";
        return view('formOeuvre', compact('oeuvre', 'proprietaires', 'titreVue', 'erreur'));

    }

    public function deleteOeuvre($id)
    {
        $oeuvre = new Oeuvre();

        try {
            $oeuvre->deleteOeuvre($id);
        } catch (\Illuminate\Database\QueryException $ex) {
            $erreur = $ex->getMessage();
            $this->getOeuvres($erreur);
        }

        return redirect('/listerOeuvres');
    }
}
