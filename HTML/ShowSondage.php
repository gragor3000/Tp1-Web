<?php
session_start();

if(!(isset($_SESSION['User']) && $_SESSION['User'] != ''))
    header("location: ../HTML/Accueil.php");
?>
<html>

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../CSS/TP1.css"/>
    <link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/sticky-footer.css">
    <link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/bootstrap-theme.css"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <!-- Bootstrap core CSS -->
</head>

<body role="document">

<div class="navbar navbar-default navbar-fixed-topt">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Triangle survey</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="../HTML/ClientMain.php">Home</a></li>
                <li><a type="submit" href="../HTML/CrtSondage.php">Creation de sondage</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Compte <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a  type="submit" href="#">Mes Sondages</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="../PHP/EndSession.php">Deconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="jumbotron2">
        <form method="post" action="../PHP/ModifSondage.php">
            <h2>Liste des sondages</h2>
            <table class="Account">
                <tr>
                    <td>
                        <select name="Liste" class="Liste" size="5" id="ListeSondage"></select>
                    </td>
                    <td>
                        <div class="textbox2">
                            <label for="inputDebut">Date de debut</label>
                            <input name="DateDebut" id="inputDebut" type="date" placeholder="Date de debut" required class="form-control">
                            <label for="inputFin">Date de fin</label>
                            <input name="DateFin" id="inputFin" type="date" required placeholder="Date de fin"
                                   class="form-control">
                            <label>Active</label> <input required name="Activate" value="1" type="radio">
                            <label>Desactive</label> <input required name="Activate" value="0" type="radio">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <button type="submit" class="btn btn-lg btn-primary " name="Modify_btn" value="Modify">Modifier
                        </button>
                        <button type="submit" class="btn btn-lg btn-success " name="Submit_btn" value="submit">Excel
                        </button>
                    </td>

                </tr>
            </table>

        </form>
    </div>
</div>


<div class="footer">
    <p class="text-muted"><a href="#">Haut de la page</a></p>
</div>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>