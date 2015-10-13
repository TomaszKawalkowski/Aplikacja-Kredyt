<?php
include_once('kredyt.php');
include_once('src/home.php');

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['kalklog']!=1) {

    $newUser = User::logIn($_POST['name'], $_POST['password']);
    if ($newUser != false) {
        $_SESSION['user'] = $newUser;
        header('location: index.php');
    }
    $r = 1;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['kalklog']==1) {

    $newUser = User::logIn($_POST['name'], $_POST['password']);
    if ($newUser != false) {
        $_SESSION['user'] = $newUser;
        header('location: kalk.php');
    }
    $r = 1;
}


?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">

    <title> Czy opłaca się spłacić wcześniej kredyt hipoteczny </title>
    <meta name="description" content="Czy opłaca się spłacić wcześniej kredyt hipoteczny">
    <meta name=keywords" content="Czy opłaca się spłacić wcześniej kredyt hipoteczny
    kupić nieruchomość z przeznaczeniem na wynajem">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top ">
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
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Spłacić wcześniej kredyt hipoteczny</a></li>
                    <!--   <li><a href="nieruchomosc.php">Kupić nieruchomość z przeznaczeniem na wynajem</a></li>-->
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

                <h1> Panel <span style="color:orangered">logowania </span>
            </div>
        </div>
    </div>


    <form action="login.php" method="post" class="anime">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 ">

                <div class="tlowstepu">
                    <?Php
                    if ($r == 1) {
                        echo '

                    <div class="well" style="background-color: dimgray; color: white;">

                           Podałeś nieprawidłowy login lub hasło.<br>
                          Jeśli nie masz jeszcze konta
                            <a href="register.php"> <img src="pics/woman-841173_640.png" alt="" style="position:relative; left: 40px; top:20px"></a>
                           </div>';
                    }
                    ?>


                    <div class="form-group">
                        <label for="comment" style="color:white">


                        </label>
                        <input class="form-control" type="text" name="name" placeholder="Nick"
                            >

                        <div class="odstep" style="height: 10px;"></div>

                        <input class="form-control" type="password" name="password"
                               placeholder="Podaj hasło">

                        <div class="odstep" style="height: 20px;"></div>


                        <div class="odstep" style="height: 20px;"></div>

                        <button type="submit" class="btn btn-info" style="width:100%"> ZALOGUJ SIĘ <i class="fa fa-sign-in"></i> </button>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4"></div>
    </form>
</div>


<script src="js/jquery-2.1.4.min.js"></script>

<script src="js/java.js"></script>
</body>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-38408838-2', 'auto');
    ga('send', 'pageview');

</script>
</html>

