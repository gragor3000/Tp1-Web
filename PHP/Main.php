<?php
    session_start();
    include("BD.php");
?>

<html>

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../CSS/TP1.css"/>
    <link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/sticky-footer.css">
    <link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/bootstrap-theme.css"/>

    <!-- Bootstrap core CSS -->

</head>

<body role="document">

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Triangle survey</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Compte <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Paramètre</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="SignUp">
    <div class="container">
        <div class="jumbotron2">
            <h1>Compte</h1>
            <div id="ListeAccount" class="Liste"></div>
            <input type="text" placeholder="Email" class="form-control">
            <input type="password" placeholder="Mot de Passe" class="form-control">
            <br>
        </div>
    </div>
</div>


<<footer class="footer">
    <p class="text-muted"><a href="#">Haut de la page</a></p>
</footer>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>

<?php
ShowAccount();


?>