<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 2015-10-28
 * Time: 13:47
 */
session_start();
// remove all session variables
session_unset();
session_destroy();

$doc = new DOMDocument();
$doc->loadHTMLFile("../HTML/Accueil.php");
echo $doc->saveHTML();

