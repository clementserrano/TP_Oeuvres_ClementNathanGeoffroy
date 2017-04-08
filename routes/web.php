<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});


// Afficher le formulaire d'authentification 
Route::get('/getLogin', 'ProprietaireController@getLogin');

// Réponse au clic sur le bouton Valider du formulaire formLogin
Route::post('/signIn', 'ProprietaireController@signIn');

// Déloguer le propriétaire
Route::get('/signOut', 'ProprietaireController@signOut');

// Afficher la liste des Oeuvres
Route::get('/listerOeuvres','OeuvreController@getOeuvres');

// Afficher une oeuvre pour pouvoir la modifier
Route::get('/modifierOeuvre/{id}','OeuvreController@updateOeuvre');

// Enregistrer la mise à jour d'une oeuvre
Route::post('/validerOeuvre','OeuvreController@validateOeuvre');

// Afficher le formulaire de saisie d'une nouvelle oeuvre
Route::get('/ajouterOeuvre','OeuvreController@addOeuvre');

// Supprimer une oeuvre
Route::get('/supprimerOeuvre/{id}','OeuvreController@deleteManga');

// Afficher la liste des réservations
Route::get('/listerReservations','ReservationController@getReservations');

// Réserver une oeuvre
Route::get('/reserverOeuvre','ReservationController@reserveOeuvre');

// Valider une réservation
Route::post('/validerReservation','ReservationController@validateReservation');

// Confirmer une réservation
Route::get('/confimerReservation/{id}','ReservationController@confirmReservation');

// Supprimer une réservation
Route::get('/supprimerReservation/{id}','ReservationController@deleteReservation');
