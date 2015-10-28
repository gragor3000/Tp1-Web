<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 2015-10-25
 * Time: 16:30
 */
include("BD.php");

if (isset($_POST['Add_btn']))//si le bouton ajouter a été peser appelle la fontion add
    if ($_POST['email'] == "" || $_POST['password'] == "") {
        echo "<script> alert('email ou mot de passe invalide') </script>";
        Admin();
    }
    else
        if(isset($_POST['admin']))
            AddAccount($_POST['email'], $_POST['password'], $_POST['admin']);
        else
            AddAccount($_POST['email'], $_POST['password'], 0);


else if (isset($_POST['Modify_btn']))//si le bouton modifier a été peser appelle la fontion modify
    if ($_POST['email'] == "" || $_POST['password'] == "") {
        echo "<script> alert('email ou mot de passe invalide') </script>";
        Admin();
    }
    else
        ModifyAccount($_POST['Liste'], $_POST['email'], $_POST['password'], $_POST['admin']);

else if (isset($_POST['Delete_btn']))//si le bouton Supprimer a été peser appelle la fontion Delete
    DeleteAccount($_POST['Liste']);

