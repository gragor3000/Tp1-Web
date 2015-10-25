<script src="../JS/sondage.js"></script>
<?php
// Connexion


/**************************************
 * Création des tables                       *
 **************************************/

function AddAccount($email, $password)
{
    try {
        $pdo = new PDO('sqlite:bd.sqlite3');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

        $pdo->exec("CREATE TABLE IF NOT EXISTS Compte (
						CompteEmail TEXT PRIMARY KEY NOT NULL,
						ComptePassword TEXT NOT NULL)");

        $insert = "INSERT INTO Compte (CompteEmail, ComptePassword) VALUES (:CompteEmail, :ComptePassword)";
        $requete = $pdo->prepare($insert);
        $requete->bindValue(':CompteEmail', $email);
        $requete->bindValue('ComptePassword', md5($password));

        // Execute la requête
        $requete->execute();




// ferme la requête
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
    $req->bindValue(':Email',$Email);
    $req->bindValue(':Password',$Password);
    $req->execute();
    $value = $req->fetchAll(PDO::FETCH_NUM);
    if($value == null){//regarde si le compte est admin ou non et charge la page en conséquence
        //header("Location: ../HTML/Accueil.htm");
        $doc = new DOMDocument();
        $doc->loadHTMLFile("../HTML/Accueil.htm");
        echo $doc->saveHTML();
        $message = "email ou mot de passe invalid";
        echo "<script type='text/javascript'>alert('$message');</script>";

    }
    else if($value[0][2] == 1)
        Admin();
    else if($value[0][2] == 0)
        header("Location : ClientMain.htm");
}

function Admin()//load et remplit la page principal de l'admin
{
    try {
        $pdo = new PDO('sqlite:bd.sqlite3');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    try{
        $req = $pdo->prepare("SELECT * FROM Compte");
        $req->execute();

        $value = $req->fetchAll();

        $doc = new DOMDocument();
        $doc->loadHTMLFile("../HTML/AdminMain.htm");

        $ii = 1;
        foreach($value as $data){//remplit ma liste de tous les comptes
            ShowAccount($doc, $data['AccountEmail'], $data['AccountisAdmin'], $ii);
            $ii++;
        }

        echo $doc->saveHTML();
    }
    catch(PDOException $ex){
        echo "Connection failed: " . $ex->getMessage();
    }


}

function ShowAccount()
{
    try {
        $pdo = new PDO('sqlite:bd.sqlite3');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    try {
        $requete = $pdo->prepare("SELECT * FROM Compte");
        // Execute la requête
        $requete->execute();
        $result = $requete->fetchAll();
       /* print_r($result);*/

        $doc = new DOMDocument();
        $doc->loadHTML("Main.php");
        $DivListe = $doc->getElementById("ListeAccount");
        $Liste = $doc->createElement('Select');

            foreach($result as $singleData)
            {
               // echo '<script> ShowAccount('. json_encode($singleData['CompteEmail']) .')</script>';
            }
        //echo json_encode($singleData);

    }
    catch (PDOException $e)
    {
        echo 'Connection failed: ' . $e->getMessage();
    }

    // ferme la requête
    $pdo = null;


}

?>