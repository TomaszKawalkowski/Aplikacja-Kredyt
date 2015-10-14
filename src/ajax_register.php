<?php
include_once('kredyt.php');
include_once('home.php');

    if ($_POST['nameajax']){
    $nameajax = $_POST['nameajax'] ;
    $sql = "SELECT * FROM Users WHERE name = '$nameajax'";
    $re = $bridge->query($sql);
        if ($re->num_rows == 1) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    if ($_POST['emailajax']){
    $emailajax = $_POST['emailajax'] ;
    $sql = "SELECT * FROM Users WHERE email = '$emailajax'";
    $re = $bridge->query($sql);
        if ($re->num_rows == 1) {
            echo 'true';
        } else {
            echo 'false';
        }
    }