<?php

namespace App\Http\Controllers;

use Request;
use App\modeles\Proprietaire;

class ProprietaireController extends Controller
{
    public function getLogin() {
        $erreur = "";
        return view('formLogin', compact('erreur'));
	}
	
	public function signIn() {
        $login = Request::input('login');
        $pwd = Request::input('pwd');
        $proprietaire = new Proprietaire();
        $connected = $proprietaire->login($login,$pwd);
        if ($connected) {
            return view('home');
        } else {
            $erreur = "login ou mot de passe inconnu!";
            return view ('formLogin', compact('erreur'));
            
        }
        
    }

    public function signOut(){
        $proprietaire = new Proprietaire();
        $proprietaire->logout();
        return view('home');
    }
}


