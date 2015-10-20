<?php
// Connexion


/**************************************
 * Création des tables                       *
 **************************************/
try {
    AddAccount("all2o@hotmail.com","test");
}
catch (PDOException $e) {
}
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

?>