@extends('layouts.master')
@section('content')
<div class="container">
    <div class="blanc">
        <h1>Liste des oeuvres</h1>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Prénom propriétaire</th>
                <th>Nom propriétaire</th>
                <th>Réserver</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        @foreach($oeuvres as $oeuvre)
        <tr>
            <td>{{ $oeuvre->titre }}</td>
            <td>{{ $oeuvre->prenom_proprietaire }}</td>
            <td>{{ $oeuvre->nom_proprietaire }}</td>
            <td style="text-align:center;"><a href="{{ url('/reserverOeuvre') }}/{{$oeuvre->id_oeuvre}}">
                <span class="glyphicon glyphicon-book" data-toggle="tooltip" data-placement="top" title="Réserver"></span></a>
            </td>
            <td style="text-align:center;"><a href="{{ url('/modifierOeuvre') }}/{{$oeuvre->id_oeuvre}}">
                <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a>
            </td>
            <td style="text-align:center;">
                <a class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                    onclick="javascript:if (confirm('Suppression confirmée ?'))
                        { window.location='{{ url('/supprimerOeuvre') }}/{{$oeuvre->id_oeuvre}}';}">
                </a>
            </td>
        </tr>
        @endforeach
        <BR> <BR>
    </table>
    <div class="col-md-6 col-md-offset-3">
        @include('error')
    </div>
</div>
@stop