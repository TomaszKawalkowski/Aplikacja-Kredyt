<?php
include_once('src/kredyt.php');
include_once('src/home.php');

session_start();
if (isset($_SESSION['user']) == true) {
    $loggedUser = $_SESSION['user'];
    $x = 1; //zmienna użyta w skrypcie zmieniająca tło dla zalogowanego użytkownika
}
if (isset($_SESSION['user']) == true && $_POST['logout'] == 'YES') {
    $loggedUser = null;
    $_SESSION['user'] = null;
    header('location: login.php');
}





if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $k = $_POST['kwota'];
    $k = str_replace(",", ".", $k);
    $p = $_POST['oprocentowanie'];
    $p = str_replace(",", ".", $p);
    $year = $_POST['year'];
    $month = $_POST['month'];
    $n = $_POST['year'] * 12 + $_POST['month'];
    if ($_POST['szybkasplata'] >= 0) {
        $w = $_POST['szybkasplata'];
        $w = str_replace(",", ".", $w);
    }

    if (($_POST['raty']) == 'rowne') {
        $s = TRUE;
    } else {
        $s = FALSE;
    }

    $kredyt = new Kredyt($k, $p, $n, $s);
    $kredyt->obliczK();
    $kredyt->odsetkiKapital();

}
ob_start();
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
                    <li><a href="kalk.php">Kalkulator Kredytowy</a></li>
                    <li><a href="formularz_kontaktowy.php">Napisz do nas</a></li>


                </ul>
            </div>
        </div>
    </div>
</nav>



<div class="container">

    <div class="row  .visible-xs-block, hidden-xs">
        <div class="col-md-12 jumbotron" style=" float:left; margin-bottom: 15px;">
            <div style="background-color:dimgray; height: 290px; margin-top:30px;" >
                <div class=" "
                     style="float:left; color: white; background-color: dimgray; margin: 0 0; width:75%; height:270px;">


                    <h1> Bankowy <span style="color:orangered">kalkulator </span></h1><br>

                    <h1>

                        kredytowy
                    </h1>
                </div>

                <div class="col-md-3 ">
                    <div style="background-color: dimgray; float:left;">
                        <?Php
                        if ($loggedUser) {
                            echo '

                                    <div class="formularzlogowania jumbotron" style="float:right; width: 100%;">
                                     <div class="form-group" style="margin-top: 0;">
                                        <div class="tlowstepu"">
                                           <strong>';
                            echo '
                                            <form action="index.php" role="form" method="POST">
                                                <input type="hidden" name="logout" value="YES">
                                                <button type="submit" class="btn btn-warning .btn-block"  style="width:100%; background-color: orangered;  border-radius: 7px; margin-top:8px;">  <i class="fa fa-sign-out"></i> logout</button>
                                            </form>';
                            echo $loggedUser->getName();
                            echo '</strong>
                                        </div>
                                        </div>
                                        </div>

                                    </div>';
                        }
                        if ($x != 1) {
                            echo '

                    <div class="formularzlogowania jumbotron" style="float:right; width: 100%; ">
                        <form action="login.php" method="post" class="anime">


                            <div class="tlowstepu">



                                <div class="form-group logform" style="margin-top: 0; ">

                                    <input class="form-control " type="text" name="name" placeholder="Nick"
                                           style="background-color: beige" id="Nick">

                                    <div class="odstep " style="height: 5px;"></div>

                                    <input class="form-control " type="password" name="password"
                                           placeholder="Podaj hasło" style="background-color: beige">


                                </div>
                                <div class="form-group" style="margin-top: 20px;">

                                    <button type="submit" class="btn btn-info"
                                            style="width:100%; background-color: orangered;  border-radius: 7px; margin-top:8px;"
                                            id="submitlog">
                                        ZALOGUJ SIĘ <i
                                            class="fa fa-sign-in"></i></button>

                                </div>

                            </div>


                        </form>


                        <form action="register.php" method="post" class="anime">

                                    <div class="tlowstepu">

                                        <div class="form-group registerform" style="margin-top: -25px;" id="div_register">

                                            <input class="form-control" type="text" name="name" id="register_name" placeholder="Nick"
                                                   value=""';
                            echo $name ? $name : '';
                            echo '>


                                            <input class="form-control" type="email" name="email" id="register_email" placeholder="Podaj email"
                                                   value=""';
                            echo $email ? $email : '';
                            echo '>


                                            <input class="form-control" name="password" type="password" id="password"
                                                   placeholder="Podaj hasło" >

                                            <div class="odstep" style="height: 3px;"></div>

                                            <input class="form-control" name="password2" type="password" id="password2"
                                                   placeholder="Potwierdź hasło" style="margin-bottom: 22px;"
                                                >
                                        </div>



                                        <div class="form-group" style="margin-top: -18px;">
                                            <button type="submit" class="btn btn-info" id="submitregister" style="width:100%; background-color: orangered;  border-radius: 7px; "> ZAREJESTRUJ SIĘ <i class="fa fa-sign-in"></i> </button>

                                        </div>
                                        </div>
                                    </div>

                        </form>
                    </div>
                </div>
            </div>
            </div>
                    ';
                        }
                        ?>
                    </div>
                    <form action="#section6" method="POST">
                        <div class="odstep .visible-md-block, hidden-md .visible-lg-block, hidden-lg" style="height: 40px;"></div>
                        <div class="well well-lg anime"
                             style="background-color: dimgray; color: white; text-align: center;"><strong>PODAJ DANE DO
                                OBLICZENIA <a style="color:orangered;">RAT KREDYTOWYCH</a> </strong>
                        </div>

                        <div class="row anime">
                            <div class="col-md-4" style="margin-top: 10px;"></div>
                            <div class="col-md-4" style="margin-top: 10px;">
                                <form action="#section6" class="form-horizontal formularz" role="form" method="POST">
                                    <div class="form-group">
                                        <label for="kwota">Podaj kwotę kredytu</label>
                                        <input class="form-control" type="number" name="kwota"
                                               placeholder="Podaj wartość ..." min="0" max="500 000 000"  step="0.01"
                                               value="<?Php echo $k ? $k : '' ?>">
                                    </div>


                                    <div class="form-group">
                                        <label for="oprocentowanie">Podaj oprocentowanie w skali roku</label>
                                        <input class="form-control" type="number" name="oprocentowanie"  step="0.01"
                                               placeholder="Wartość w % ..."
                                               min="0" max="100" value="<?Php echo $p ? $p : '' ?>">
                                    </div>


                                    <div class="form-group">
                                        <label for="year">Okres spłaty</label>
                                        Ilość lat <input class="beige" type="number" name="year" size="4"
                                                         style="width:60px" min="0" max="100"
                                                         value="<?Php echo $year ? $year : '' ?>">

                                        Ilość miesięcy <input class="beige" type="number" name="month" size="3"
                                                              style="width:60px" min="0" max="1200"
                                                              value="<?Php echo $month ? $month : '' ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="raty">Sposób spłaty </label><br>
                                        <label class="radio-inline"><input type="radio" name="raty" value="rowne">Raty
                                            równe</label>
                                        <label class="radio-inline"><input type="radio" name="raty" value="malejace">Raty
                                            malejące</label>
                                    </div>


                                    <button type="submit" class="btn btn-primary btn-block"
                                            style="background-color: dimgray;"> O B L I C
                                        Z
                                    </button>
                                    <div class="odstep" style="height: 5px;"></div>
                                    <div class="odstep" style="height: 5px; background-color: orangered;"></div>
                                </form>
                            </div>

                            <div class="col-md-4" style="margin-top: 10px;"></div>
                        </div>
                        <div class="odstep" style="height: 10px;"></div>

                        <br>

                        <?php

                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        echo '

         <div class="well well-lg anime" style="background-color: dimgray; color: white; text-align: center">'; ?><h3>
                            PONIŻEJ PRZEDSTAWIAMY HARMONOGRAM SPŁAT<br></h3>

                        <h2><strong> <a style="color:orangered;">W ROZBICIU NA ODSETKI I KAPITAŁ</a></strong>

                            <h2> <?php
                                echo ' </div>

      <div id="section6"></div>

    <div class ="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">

            <div class="panel panel-default anime" style="background-color: dimgray; color: white; text-align: center; padding:10px;">
                Harmonogram<br>


                <div class="panel-body"  >
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Rata</th>
                            <th>Kapitał </th>
                            <th>Odsetki </th>
                            <th>Razem </th>

                        </tr>
                        </thead>
                        <tbody>
                            ';
                                for ($i = 1; $i <= $n; $i++) {
                                    $p = $i - 1;
                                    echo '<tr>
                                <td>' . "$i" . '</td>
                                <td>';
                                    foreach ($kredyt->kapitalTablica as $key => $value)
                                        if ($key == $p) {
                                            echo number_format($value, $decimals = 2, $dec_point = ".", $thousands_sep = " ") . "";

                                        }
                                    echo '</td>
                                 <td>';
                                    foreach ($kredyt->odsetkiTablica as $key => $value)
                                        if ($key == $p) {
                                            echo number_format($value, $decimals = 2, $dec_point = ".", $thousands_sep = " ") . "";

                                        }
                                    echo '</td>
                                 <td>';
                                    foreach ($kredyt->splaty as $key => $value)
                                        if ($key == $p) {
                                            echo number_format($value, $decimals = 2, $dec_point = ".", $thousands_sep = " ") . "";

                                        }
                                    echo '</td>

                            </tr>
                            ';
                                }
                                echo '

                        </tbody>
                    </table>
                </div>


            </div>

        </div>
        <div class="col-md-4"></div>
    </div>




    ';
                                }
                                ?>

                    </form>
                    <script src="js/jquery-2.1.4.min.js"></script>
                    <script src="js/java.js"></script>
                    <script>
                        $(document).on('ready', function () {
                            <?php
                            if ($x==1){echo "var x = 1;";
                            }?>

                            if (x == 1) {
                                $('body').addClass('logged');

                                console.log('jezd');
                            }
                            <?php
                                if ($x != 1) {
                                    echo
                                    "var x = 0;";
                                }
                               ?>
                            if (x != 1) {
                                $('body').removeClass('logged');
                                console.log('niema');
                            }
                        });
                    </script>
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

