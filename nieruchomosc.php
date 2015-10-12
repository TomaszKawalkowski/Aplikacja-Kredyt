<?php
include_once('kredyt.php');
if($_SERVER['REQUEST_METHOD'] === 'POST'){
   // function clean($string) {
     //   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    //    return preg_replace('/[^A-Za-z0-9\-\@\.]/', '', $string); // Removes special chars.
  //  }
    $name = ($_POST['Name']);
    $email = ($_POST['Email']);
    $message = ($_POST['Message']);
  //  var_dump($email);echo'<br>';
  //  var_dump($message);echo'<br>';
  //  var_dump($name);echo'<br>';
}

?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">

    <title> Czy opłaca się spłacić wcześniej kredyt hipoteczny </title>
    <meta name = "description" content="Czy opłaca się spłacić wcześniej kredyt hipoteczny">
    <meta name = keywords" content="Czy opłaca się spłacić wcześniej kredyt hipoteczny
    kupić nieruchomość z przeznaczeniem na wynajem">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >



    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" >

</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top " >
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Czy opłaca się</a>
        </div>
        <div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav" >
                    <li><a href="index.php">Spłacić wcześniej kredyt hipoteczny</a></li>
                    <li><a href="nieruchomosc.php">Kupić nieruchomość z przeznaczeniem na wynajem</a></li>
                    <li><a href="kalk.php">Kalkulator Kredytowy</a></li>
                    <li><a href="formularz_kontaktowy.php">Napisz do nas</a></li>
                    <li><a href="register.php">Zarejestruj się</a></li>
                    <li><a href="login.php">Zaloguj</a></li>

                </ul>
            </div>
        </div>
    </div>
</nav>


<div class="container">
    <div class="odstep" style="height: 30px;"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron" style="color: white; background-color: dimgray;">
                <h1> Strona <a style="color:orangered"> w opracowaniu ... </a>
            </div>
        </div>
    </div>



</body>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-38408838-2', 'auto');
    ga('send', 'pageview');

</script>
</html>

