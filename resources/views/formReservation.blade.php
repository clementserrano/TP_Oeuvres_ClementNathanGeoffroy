@extends('layouts.master')
@section('content')
{!! Form::open(['url'=>'validerReservation']) !!}
<div class="col-md-12 well well-sm">
    <center><h1>{{$titreVue or ''}}</h1></center>
    <div class="form-horizontal">    
        <div class="form-group">
            <input type="hidden" name="id_oeuvre" value="{{$oeuvre->id_oeuvre or 0}}"/>
            <label class="col-md-3 control-label">Titre : </label>
            <label class="col-md-6 form-control-static">{{$oeuvre->titre or ''}}</label>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Date réservation : </label>
            <div class="col-md-3">
                    <input type="text" name="date_reservation" id="datepicker" value="" class="form-control" placeholder="JJ-MM-AAAA" required/>
            </div>
        </div>        
        <div class="form-group">
            <label class="col-md-3 control-label">Adhérent : </label>
            <div class="col-md-3">
                <select class='form-control' name='cbAdherent' required>
                    <OPTION VALUE=0>Sélectionner un adhérent</option>
                    @foreach($adherents as $adherent)
                        selected=""
                        <option value="{{$adherent->id_adherent}}">{{$adherent->prenom_adherent}} {{$adherent->nom_adherent}} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-default btn-primary">
                    <span class="glyphicon glyphicon-ok"></span> Valider
                </button>
                &nbsp;
                <button type="button" class="btn btn-default btn-primary" 
                    onclick="javascript: window.location = '{{url('/listerOeuvres')}}';">
                    <span class="glyphicon glyphicon-remove"></span> Annuler
                </button>
            </div>           
        </div>
        <div class="col-md-6 col-md-offset-3">
            @include('error')
        </div>        
    </div>
</div>
{!! Form::close() !!}
@stop