<?php
/**
 * Created by PhpStorm.
 * User: 1253250
 * Date: 30/10/2015
 * Time: 10:49
 */
include("BD.php");
if(isset($_POST['Submit_btn']))
    PhpExcel();
    else
        ModifSondage($_POST['Liste'],$_POST['DateDebut'],$_POST['DateFin'],$_POST['Activate']);
