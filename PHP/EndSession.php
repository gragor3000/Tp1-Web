<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 2015-10-28
 * Time: 13:47
 */

// remove all session variables
session_unset();

$doc = new DOMDocument();
$doc->loadHTMLFile("../HTML/Accueil.php");
echo $doc->saveHTML();

