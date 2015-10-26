<script src="../JS/sondage.js"></script>
<?php
// Connexion


/**************************************
 * Création des tables                       *
 **************************************/

function AddAccount($email, $password, $Admin)//ajoute un compte
{
    try {
        $pdo = new PDO('sqlite:bd.sqlite3');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    $pdo->exec("CREATE TABLE IF NOT EXISTS Compte (
						CompteEmail TEXT PRIMARY KEY NOT NULL UNIQUE,
						ComptePassword TEXT NOT NULL,
						Compte Admin INTEGER NOT NULL,)");

    $insert = "INSERT INTO Compte (CompteEmail, ComptePassword, CompteAdmin) VALUES (:CompteEmail, :ComptePassword,:Admin)";
    $requete = $pdo->prepare($insert);
    $requete->bindValue(':CompteEmail', $email);
    $requete->bindValue(':ComptePassword', md5($password));
    if ($Admin == "on")
        $requete->bindValue(':Admin', 1);
    else
        $requete->bindValue(':Admin', 0);

    // Execute la requête
    $requete->execute();


    Admin();
    echo "<script> alert('Le compte : (" . $email . ") a ete ajouter')</script>";
    $pdo = null;
}

function Login($Email, $Password)//load la page de la personne si les info rentre sont bonne et charge la page en fontion
{
    try {
        $pdo = new PDO('sqlite:bd.sqlite3');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    $Select = "SELECT * FROM Compte WHERE Compte.CompteEmail = :Email AND Compte.ComptePassword = :Password";
    $req = $pdo->prepare($Select);
    $req->bindValue(':Email', $Email);
    $req->bindValue(':Password', md5($Password));
    $req->execute();
    $value = $req->fetchAll(PDO::FETCH_NUM);
    if ($value == null) {//regarde si le compte est admin ou non et charge la page en conséquence
        $doc = new DOMDocument();
        $doc->loadHTMLFile("../HTML/Accueil.htm");
        echo $doc->saveHTML();
        echo "<script type='text/javascript'>alert('email ou mot de passe invalid');</script>";
        $pdo = null;
    } else if ($value[0][2] == 1)
        Admin();
    else if ($value[0][2] == 0)
        Sondeur();

}

function Admin()//load et rempli la page principal de l'admin
{
    try {
        $pdo = new PDO('sqlite:bd.sqlite3');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    try {
        $req = $pdo->prepare("SELECT CompteEmail FROM Compte");
        $req->execute();

        $value = $req->fetchAll();

        $doc = new DOMDocument();
        $doc->loadHTMLFile("../HTML/AdminMain.htm");

        $ii = 0;
        foreach ($value as $data) {//remplit ma liste de tous les comptes
            ShowAccount($doc, $data['CompteEmail'], $ii);
            $ii++;
        }
        echo $doc->saveHTML();
        $pdo = null;
    } catch (PDOException $ex) {
        echo "Connection failed: " . $ex->getMessage();
    }


}

function ShowAccount($doc, $email, $ii)//load tous les comptes dans la liste
{
    $lst = $doc->getElementById('ListeCompte');
    $ele = $doc->createElement("option");
    $ele->setAttribute("id", $ii);
    $ele->setAttribute("value", $email);
    if ($ii == 0)
        $ele->setAttribute("selected", "selected");
    $ele->appendChild($doc->createTextNode($email));
    $lst->appendChild($ele);
}

function AccountInfo()//affiche les info du compte sélectionner
{

}

function ModifyAccount($oldEmail, $Email, $Password, $Admin)//modifie le compte sélectionné
{
    try {
        $pdo = new PDO('sqlite:bd.sqlite3');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    $Update = "Update Compte SET CompteEmail = :Email, ComptePassword = :Password, CompteAdmin = :Admin WHERE CompteEmail = :oldEmail";
    $req = $pdo->prepare($Update);
    $req->bindValue(':Email', $Email);
    $req->bindValue(':Password', md5($Password));
    if ($Admin == "on")
        $req->bindValue(':Admin', 1);
    else
        $req->bindValue(':Admin', 0);
    $req->bindValue(':oldEmail', $oldEmail);
    $req->execute();
    Admin();
    echo "<script> alert('Le compte :" . $oldEmail . " a ete modifier')</script>";
    $pdo = null;
}

function DeleteAccount($Email)//delete le compte sélectionné
{
    try {
        $pdo = new PDO('sqlite:bd.sqlite3');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    $Delete = "DELETE FROM Compte WHERE CompteEmail = :Email";
    $req = $pdo->prepare($Delete);
    $req->bindValue(':Email', $Email);
    $req->execute();
    Admin();
    echo "<script> alert('Le compte : (" . $Email . ") a ete supprimer')</script>";
    $pdo = null;
}

function Sondeur()//load la page d'un compte d'un sondeur
{
    try {
        $doc = new DOMDocument();
        $doc->loadHTMLFile("../HTML/ClientMain.htm");


        echo $doc->saveHTML();
    } catch (PDOException $ex) {
        echo "Connection failed: " . $ex->getMessage();
    }
}

function CreationSondage($nbQuestion)//créer le sondage
{
    $doc = new DOMDocument();
    $doc->loadHTMLFile("../HTML/AdminMain.htm");
    for($ii=0;$ii<$nbQuestion;$ii++){

    }
}

function AjoutQuestion($nbQuestion)
{

}

?>