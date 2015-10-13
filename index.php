<?php
include_once('kredyt.php');
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
    if (($_POST['czas']) == 'krotszy') {
        $krotszy = TRUE;
    } else {
        $krotszy = FALSE;
    }


    $kredyt = new Kredyt($k, $p, $n, $s);
    $kredyt1 = new Kredyt(($k - $w), $p, $n, $s);


    $kredyt3 = new Kredyt (($k - $w), $p, $n, $s);


    $kredyt->obliczK();
    $kredyt1->obliczK();

    $kredyt->odsetkiKapital();
    $kredyt1->odsetkiKapital();


    if ($_POST['czas'] == 'krotszy') {

        $kredyt3->obliczK();
        $kredyt3->odsetkiKapital();
        $j = $n; //przypisaie do zmiennej ilości rat
        $k2 = [];
        $k3 = [];

        while ($k2[0] >= $k3[0]) {
            $k2 = $kredyt->splaty;
            $k3 = $kredyt3->splaty;

            $kredyt3 = new Kredyt (($k - $w), $p, $j, $s);
            $j = $j - 1;
            $kredyt3->obliczK();
        }

        $kredyt1 = new Kredyt (($k - $w), $p, $j + 1, $s);
        $kredyt1->obliczK();
        $kredyt1->odsetkiKapital();

        $krotszelata = 0;

        if (floor(($j + 1) / 12) >= 1) {
            $krotszelata = floor(($j + 1) / 12); //oblicza ilość lat kredytu przy skróceniu okresu kredytowania
        }
        $krotszemies = ($j + 1) - $krotszelata * 12;
        //poniższe dwa ify do ustalenia liczby pojed/mnogiej w tekście dla lat miesięcy
        if ($krotszelata > 1) {
            $b = true;
        } else {
            $b = false;
        }
        if ($krotszemies > 1) {
            $mies = true;
        } else {
            $mies = false;
        }

        $latach = ' latach';
        $roku = ' roku';
        $miesiacu = ' miesiącu';
        $miesiacach = ' miesiącach';
    }
    $v = 0; //zmienna do zapisu oszczędności narastająco ;
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

    <div class="row">
        <div class="col-md-12">
            <div style="background-color:dimgray; height: 270px;">
                <div class=" jumbotron"
                     style="float:left; color: white; background-color: dimgray; margin: 0 0; width:75%; height:270px;">


                    <h1> Czy <span style="color:orangered">opłaca </span> się</h1><br>

                    <h1>

                        <small style="color: white;">spłacić wcześniej kredyt hipoteczny</small>
                        ???
                    </h1>
                </div>

                <div style="background-color: dimgray">
                    <?Php
                    if ($loggedUser) {
                        echo '

                                    <div class="formularzlogowania jumbotron" style="float:right; width: 17%; height: 270px;">
                                     <div class="form-group" style="margin-top: 5px;">
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
                    if ($x!=1) {
                        echo '

                    <div class="formularzlogowania jumbotron" style="float:right; width: 17%; height: 270px;">
                        <form action="login.php" method="post" class="anime">


                            <div class="tlowstepu">



                                <div class="form-group logform" style="margin-top: 15px; ">

                                    <input class="form-control " type="text" name="name" placeholder="Nick"
                                           style="background-color: beige" id="Nick">

                                    <div class="odstep " style="height: 5px;"></div>

                                    <input class="form-control " type="password" name="password"
                                           placeholder="Podaj hasło" style="background-color: beige">


                                </div>
                                <div class="form-group" style="margin-top: 3px;">

                                    <button type="submit" class="btn btn-info"
                                            style="width:100%; background-color: orangered;  border-radius: 7px; margin-top:8px;"
                                            id="submitlog">
                                        ZALOGUJ SIĘ <i
                                            class="fa fa-sign-in"></i></button>

                                </div>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>';
                    }
                    ?>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="well  anime"
                                 style="background-color: dimgray; color: white; text-align: center;"><h3><strong>PODAJ
                                        DANE DO OBLICZENIA <span style="color:orangered;">OSZCZĘDNOŚCI</span> PRZY
                                        WCZEŚNIEJSZEJ SPŁACIE
                                        KREDYTU
                                    </strong></h3>


                            </div>
                        </div>
                    </div>
                    <div class="row anime">
                        <div class="col-md-4" style="margin-top: 30px;">
                            <form action="#section6" class="form-horizontal formularz" role="form" method="POST">
                                <div class="form-group">
                                    <label for="kwota">Podaj kwotę kredytu</label>
                                    <input class="form-control" type="number" name="kwota"
                                           placeholder="Podaj wartość ..." min="0"
                                           max="500 000 000"
                                           value="<?Php echo $k ? $k : '' ?>">
                                </div>


                                <div class="form-group">
                                    <label for="oprocentowanie">Podaj oprocentowanie w skali roku</label>
                                    <input class="form-control" type="number" name="oprocentowanie"
                                           placeholder="Wartość w % ..."
                                           min="0" max="100" value="<?Php echo $p ? $p : '' ?>">
                                </div>


                                <div class="form-group">
                                    <label for="year">Okres spłaty</label>
                                    Ilość lat <input class="beige" type="number" name="year" size="4" style="width:60px"
                                                     min="0"
                                                     max="100"
                                                     value="<?Php echo $year ? $year : '' ?>">

                                    Ilość miesięcy <input class="beige" type="number" name="month" size="3"
                                                          style="width:60px" min="0"
                                                          max="1200"
                                                          value="<?Php echo $month ? $month : '' ?>">
                                </div>

                                <div class="form-group">
                                    <label for="raty">Sposób spłaty </label><br>
                                    <label class="radio-inline"><input class="beige" type="radio" name="raty"
                                                                       value="rowne">Raty
                                        równe</label>
                                    <label class="radio-inline"><input class="beige" type="radio" name="raty"
                                                                       value="malejace">Raty
                                        malejące</label>
                                </div>

                                <div class="form-group">
                                    <label for="year">Kwota wcześniejszej spłaty</label>
                                    <input class="form-control" type="number" name='szybkasplata'
                                           placeholder="Podaj wartość ..."
                                           min="0" max="500 000 000"
                                           value="<?Php echo $w ? $w : '' ?>">
                                </div>

                                <div class="form-group">
                                    <label for="year">Mniejsza rata czy skrócony okres spłaty </label><br>
                                    <label class="radio-inline"><input class="beige" type="radio" name="czas"
                                                                       value="bezzmian">mniejsza
                                        rata</label>
                                    <label class="radio-inline"><input class="beige" type="radio" name="czas"
                                                                       value="krotszy">krótszy
                                        okres
                                        spłaty</label>
                                </div>


                                <button type="submit" class="btn btn-primary btn-block " id="oblicz"
                                        style="background-color: dimgray;">
                                    O B L I C Z &nbsp &nbsp <i class="fa fa-check-square"></i>
                                </button>
                                <div class="odstep" style="height: 5px;"></div>
                                <div class="odstep" style="height: 5px; background-color: orangered;"></div>
                            </form>
                        </div>

                        <div class="odstep" style="height: 10px;"></div>


                        <div class="col-md-8">
                            <div class="tlowstepu anime">
                                <p class="well well-lg wstep anime">


                                    Już ponad 10 % Polaków ma kredyt hipoteczny. Część z nas niezależnie od spłacanego
                                    kredytu,
                                    gromadzi równolegle oszczędności. Wówczas powstaje pytanie czy racjonalnym jest
                                    spłacenie
                                    kredytu przynajmniej w części, wcześniej. Abstrahując od konieczności posiadania
                                    środków na
                                    czarną
                                    godzinę (tzw. poduszki finansowej), z ekonomicznego
                                    punkty widzenia , kredytu <a style="color:orangered; "><strong>nie
                                            warto</strong></a> spłacać w dwóch przypadkach:<br><br>
                                    <a style="color:orangered; "><strong>Pierwszy:</strong></a> <br>– jeśli mamy
                                    możliwość
                                    zainwestowania oszczędności z wyższą stopą zwrotu niż oprocentowany jest kredyt.<br><br>
                                    <a style="color:orangered; "><strong>Drugi:</strong></a> <br>– jeśli w najbliższym
                                    czasie
                                    zamierzamy
                                    zaciągnąć jakikolwiek inny kredyt, np. na samochód.
                                    Oprocentowanie takiego kredytu będzie zazwyczaj znacznie wyższe niż kredytu
                                    hipotecznego. Czyni
                                    to
                                    bezzasadnym spłacanie kredytu mieszkaniowego i zastąpienie jego części kredytem
                                    droższym.
                                    <br><br>
                                    W pozostałych przypadkach spłata wcześniejsza kredytu jest zasadna. Ile i w jakim
                                    okresie możemy
                                    zaoszczędzić, mogą Państwo sprawdzić podając podstawowe dane swojego kredytu oraz
                                    szacowaną
                                    kwotę
                                    wcześniejszej spłaty. Po spłacie możemy skrócić okres kredytowania pozostawiając
                                    wysokość raty
                                    na
                                    dotychczasowym poziomie lub pozostawić okres spłaty jak
                                    dotychczas z mniejszą miesięczną ratą. <br><br>
                                    Po wypełnieniu formularza oraz kliknięciu oblicz, otrzymają Państwo zestawienie
                                    oszczędności wynikających z wcześniejszej spłaty.


                            </div>
                        </div>
                    </div>


                    <div class="odstep" style="height: 30px;"></div>


                    <div id="section6"></div>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        echo '

         <div class="well well-lg "  style="background-color: dimgray; color: white; text-align: center; margin-top: 40px;">'; ?>
                        <?Php

                        if ($krotszy == true) {
                            echo "<h3>Wybrałeś krótszy okres kredytowania. Kredyt spłacisz po ";

                            if ($krotszelata != 0) {
                                echo $krotszelata;
                                echo $b ? $latach : $roku;
                                echo " i ";
                            }
                            if ($krotszemies != 0) {
                                echo $krotszemies;
                                echo $mies ? $miesiacach : $miesiacu;
                                echo ".</h3>";
                            }


                        } ?>
                        <h3>Podane
                            przez Ciebie dane oraz kwota wcześniej spłaty wygenerują<br></h3>

                        <h2><strong> <a style="color:orangered;">##test## PLN oszczędności w odsetkach !!!</a></strong>
                        </h2>

                        <?php
                        echo ' </div>



    <div class ="row">

        <div class="col-md-4">

            <div class="panel panel-default " style="background-color: dimgray; color: white; text-align: center; padding:10px;">
                Harmonogram<br>
                Sytuacja obecna

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

        <div class="col-md-4">
            <div class="panel panel-default " style="background-color: dimgray; color: white; text-align: center; padding:10px;">
                Harmonogram<br>
                Po wcześniej spłacie

                <div class="panel-body">
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
                            foreach ($kredyt1->kapitalTablica as $key => $value)
                                if ($key == $p) {

                                    if ($value <= 1) {
                                        $value = 0;
                                    } else {
                                        echo number_format($value, $decimals = 2, $dec_point = ".", $thousands_sep = " ") . "";
                                    }
                                }
                            echo '</td>
                               <td>';
                            foreach ($kredyt1->odsetkiTablica as $key => $value)
                                if ($key == $p) {

                                    if ($value < 1) {
                                        $value = 0;
                                    } else {
                                        echo number_format($value, $decimals = 2, $dec_point = ".", $thousands_sep = " ") . "";
                                    }
                                }
                            echo '</td>
                               <td>';
                            foreach ($kredyt1->splaty as $key => $value)
                                if ($key == $p) {
                                    if ($value < 1) {
                                        $value = 0;
                                    } else {
                                        echo number_format($value, $decimals = 2, $dec_point = ".", $thousands_sep = " ") . "";
                                    }
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

        <div class="col-md-4">
            <div class="panel panel-default " style="background-color: dimgray; color: white; text-align: center; padding:10px;">
                Oszczędności<br><br>


               <div class="panel-body"  >
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Rata </th>
                                <th> Odsetki</th>
                                <th style="color:orangered">Narastająco</th>

                            </tr>
                        </thead>
                            <tbody>
                                ';
                        for ($i = 1; $i <= $n; $i++) {
                            $p = $i - 1;
                            $roznica[] = $kredyt->odsetkiTablica[$p] - $kredyt1->odsetkiTablica[$p];

                        }
                        for ($i = 1; $i <= $n; $i++) {
                            $p = $i - 1;
                            echo '<tr>
                                                <td>' . "$i" . '</td>

                                                <td>';

                            foreach ($roznica as $key => $value) {
                                if ($key == $p) {
                                    $b = $value;
                                    echo number_format($b, $decimals = 2, $dec_point = ".", $thousands_sep = " ") . "";
                                }
                            }
                            echo '</td>
                                                <td>
                                                ';
                            $v = $b + $v;
                            echo '<a style="color:orangered"><strong>';
                            echo number_format($v, $decimals = 2, $dec_point = ".", $thousands_sep = " ") . "";
                            $h = round($v, 2);
                            $zysk = strval(number_format($h, $decimals = 2, $dec_point = ".", $thousands_sep = " ") . "");

                            echo '</strong>';
                            echo '
                                                </td>

                                                </tr>
                                    ';
                        }
                        echo str_replace("##test##", $zysk, ob_get_clean());

                        echo '

                            </tbody>
                    </table>
                </div>
             </div>
        </div>

    </div>
    </div>
    </div>
    ';
                    }
                    ?>

                </div>

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
</body>
</html>

