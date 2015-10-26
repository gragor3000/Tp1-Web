<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 2015-10-25
 * Time: 16:30
 */
include("BD.php");

if (isset($_POST['Add_btn']))
    AddAccount($_POST['email'],$_POST['password'],$_POST['admin']);
 else if (isset($_POST['Modify_btn']))
     ModifyAccount($_POST['Liste'],$_POST['email'],$_POST['password'],$_POST['admin']);
 else if (isset($_POST['Delete_btn']))
     DeleteAccount($_POST['Liste']);

