<!doctype html>
<html lang="fr">
    <head>
        {!! Html::style('css/bootstrap.css') !!}
        {!! Html::style('css/mangas.css') !!}
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://jqueryui.com/resources/demos/datepicker/i18n/datepicker-fr.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#datepicker').datepicker($.datepicker.regional['fr']);
                $('#datepicker').datepicker( "option", "dateFormat", 'dd-mm-yy');
                $('#datepicker').datepicker("setDate",'<?=isset($date_reservation)?$date_reservation:null;?>');
            });
        </script>

    </head>
    <body class="body">
        <div class="container">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar+ bvn"></span>
                        </button>
                        <a class="navbar-brand" href="{{ url('/') }}">Oeuvres</a>
                    </div>
                    @if (Session::get('id') == 0)
                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-nav navbar-right">                             
                            <li><a href="{{ url('/getLogin') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Se connecter</a></li>
                        </ul> 
                    </div>
                    @endif
                    @if (Session::get('id') > 0)                         
                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-nav">                           
                            <li><a href="{{ url('/listerOeuvres') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Lister</a></li>
                            <li><a href="{{ url('/ajouterOeuvre') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Ajouter</a></li>
                            <li><a href="{{ url('/listerReservations') }}"data-toggle="collapse" data-target=".navbar-collapse.in">Réservations</a></li>                       
                        </ul>  
                        <ul class="nav navbar-nav navbar-right">                             
                            <li><a href="{{ url('signOut') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Se déconnecter</a></li>
                        </ul>                         
                    </div>
                    @endif   
                </div><!--/.container-fluid -->
            </nav>
        </div> 
        <div class="container">
            @yield('content')
        </div>
        {!! Html::script('js/bootstrap.min.js') !!}
		{!! Html::script('js/bootstrap.js') !!}
    </body>
</html>
