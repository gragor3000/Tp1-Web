<?php
/**
 * Created by PhpStorm.
 * User: 1253250
 * Date: 22/10/2015
 * Time: 15:33
 */
include("BD.php");
Login($_POST['email'], $_POST['password']);
$_SESSION['User'] = $_POST['email'];