<?php
session_start();
include("BD.php")

?>
<html>

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../CSS/TP1.css"/>
    <link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/sticky-footer.css">
    <link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/bootstrap-theme.css"/>


</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Triangle Survey </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" placeholder="Email" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Mot de Passe" class="form-control">
                </div>
                <label>Se souvenir de moi</label> <input type="checkbox">
                <button type="submit" class="btn btn-success">Connexion</button>
            </form>
        </div>

    </div>
</nav>
<div class="SignUp">
    <div class="container">
        <div class="jumbotron">
            <h1>Inscrit Toi !</h1>

            <p class="lead">Si vous n'avez pas de compte existant veuillez créer votre compte ici !</p>
            <input type="text" placeholder="Email" class="form-control">
            <input type="password" placeholder="Mot de Passe" class="form-control">
            <br>

            <p><a class="btn btn-lg btn-primary" href="#" role="button">Inscription</a></p>
        </div>
    </div>
</div>


<footer class="footer">
    <p class="text-muted"><a href="#">Haut de la page</a></p>
</footer>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>

