<script src="../JS/sondage.js"></script>
<?php
// Connexion


/**************************************
 * Création des tables                       *
 **************************************/


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
        Sondeur($Email);

    setcookie("email", $Email, time() + (86400 * 30), "/");
    setcookie("password", $Password, time() + (86400 * 30), "/");


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

function Sondeur($email)//load la page d'un compte d'un sondeur
{
    try {
        $doc = new DOMDocument();
        $doc->loadHTMLFile("../HTML/ClientMain.htm");
        $h1 = $doc->createElement("h1");
        $h1->appendChild($doc->createTextNode("Bienvenue " . $email . " !"));
        $h1->setAttribute("class", "Titre");
        $div = $doc->GetElementById("container");
        $div->insertBefore($h1, $div->firstChild);
        echo $doc->saveHTML();
    } catch (PDOException $ex) {
        echo "Connection failed: " . $ex->getMessage();
    }
}

function CreationSondage($post)//créer le nouveau sondage
{
    try {
        $pdo = new PDO('sqlite:bd.sqlite3');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    $insert = "INSERT INTO Sondage(SondageMdp,SondageCompte) VALUES(:SondageMdp,:SondageCompte)";
    $requete = $pdo->prepare($insert);
    $mdp = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
    $requete->bindValue(':SondageMdp',$mdp);
    $requete->bindValue(':SondageCompte',$_COOKIE['email']);

    // Execute la requête
    $requete->execute();

    $pdo = null;

    $doc = new DOMDocument();
    $doc->loadHTMLFile("../HTML/Question.htm");
    $Questions = $doc->getElementById('Questions');
    $h1 = $doc->createElement("h1");
    $h1->appendChild($doc->createTextNode("Mot de passe : ".$mdp));
    $Questions->appendChild($h1);
    echo $doc->saveHTML();
    AddQuestions($post);
}


function CreationCorpsSondage($nbQuestion)//créer le corps
{

    $doc = new DOMDocument();
    $doc->loadHTMLFile("../HTML/Question.htm");
    for ($ii = 1; $ii <= $nbQuestion; $ii++) {
        AjoutQuestion($doc, $ii);
    }
    //bouton de confirmation
    $button = $doc->createElement("button");
    $button->setAttribute("type", "submit");
    $button->setAttribute("class", "btn btn-lg btn-default");
    $button->appendChild($doc->createTextNode("Confirmer "));
    $glyphSpan = $doc->createElement("span");
    $glyphSpan->setAttribute("class", "glyphicon glyphicon-ok-circle");
    $glyphSpan->setAttribute("aria-hidden", "true");
    $button->appendChild($glyphSpan);

    $Questions = $doc->getElementById('Questions');
    $Questions->appendChild($button);
    echo $doc->saveHTML();
}

function AjoutQuestion($doc, $ii)//ajoute le corps de question prête a être créer
{
    //div contenant toute les questions
    $Questions = $doc->getElementById('Questions');
    $Questions->setAttribute("style", "margin-bottom : 10%");

    //div de la question
    $div = $doc->createElement("div");
    $div->setAttribute("id", "Question" . $ii);
    $div->setAttribute("style", "color : black");

    //textbox de la question
    $Text = $doc->createElement("textArea");
    $Text->setAttribute("Name", "Question" . $ii);
    $Text->setAttribute("style", "width : 20%;height : 8%;");

    //titre de la question
    $label = $doc->createElement("label");
    $label->setAttribute("style", "color : white");
    $label->appendChild($doc->createTextNode("Question " . $ii . ":"));

    //label du type de question a développement
    $labelT1 = $doc->createElement("label");
    $labelT1->setAttribute("style", "color : white");
    $labelT1->appendChild($doc->createTextNode(" Developpement: "));

    //label du type de question d'appréciation
    $labelT2 = $doc->createElement("label");
    $labelT2->setAttribute("style", "color : white");
    $labelT2->appendChild($doc->createTextNode(" Appreciation: "));

    //radio button de développement
    $Type1 = $doc->createElement("input");
    $Type1->setAttribute("type", "radio");
    $Type1->setAttribute("name", "Type" . $ii);
    $Type1->setAttribute("value", "0");
    $Type1->setAttribute("checked", "checked");
    $labelT1->appendChild($Type1);

    //radio button d'appréciation
    $Type2 = $doc->createElement("input");
    $Type2->setAttribute("type", "radio");
    $Type2->setAttribute("name", "Type" . $ii);
    $Type2->setAttribute("value", "1");
    $labelT2->appendChild($Type2);


    $br1 = $doc->createElement("br");
    $br2 = $doc->createElement("br");

    $div->appendChild($label);
    $div->appendChild($br1);
    $div->appendChild($Text);
    $div->appendChild($br2);
    $div->appendChild($labelT1);
    $div->appendChild($labelT2);
    $Questions->appendChild($div);
}

function AddQuestions($post)//ajoute les questions au sondage
{

}
?>