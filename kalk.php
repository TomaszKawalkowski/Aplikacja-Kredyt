<?php
include_once('kredyt.php');
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $k = $_POST['kwota'];
    $k = str_replace(",",".",$k);
    $p = $_POST['oprocentowanie'];
    $p = str_replace(",",".",$p);
    $year = $_POST['year'];
    $month = $_POST['month'];
    $n = $_POST['year']*12+$_POST['month'];
    if($_POST['szybkasplata']>=0){
        $w = $_POST['szybkasplata'];
        $w = str_replace(",",".",$w);
    }

    if(($_POST['raty'])=='rowne'){
        $s = TRUE;
    }
    else{$s=FALSE;}

    $kredyt = new Kredyt($k,$p,$n,$s);
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
    <meta name = "description" content="Czy opłaca się spłacić wcześniej kredyt hipoteczny">
    <meta name = keywords" content="Czy opłaca się spłacić wcześniej kredyt hipoteczny
    kupić nieruchomość z przeznaczeniem na wynajem">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >



    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
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

<form action="kalk.php#section6" method="POST">
<div class="container">
    <div class="odstep" style="height: 30px;"></div>
    <div class="row">

        <div class="col-md-12">
            <div class="jumbotron" style="color: white; background-color: dimgray;">
                <h1> Bankowy <a style="color:orangered">kalkulator </a>kredytowy </h1><br>
              <!--  <h1><small style="color: white;"> </small></h1>-->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tlowstepu anime">
                <p class="well well-lg wstep anime">
                   Poniżej przedstawiamy kalkulator kredytowy, który jako  <span style="color:orangered; "  ><strong>jeden</strong></span> z nielicznych przedstawia pełny
                    harmonogram z podziałem na część odsetkową i kapitałową każdej raty.<br>
            </div>
        </div>
    </div>

    <div class="odstep" style="height: 10px;"></div>
    <div class="well well-lg anime" style="background-color: dimgray; color: white; text-align: center;"><strong>PODAJ DANE DO OBLICZENIA <a style="color:orangered;">RAT KREDYTOWYCH</a> </strong>
    </div>

    <div class="row anime">
        <div class="col-md-4" style="margin-top: 10px;"></div>
        <div class="col-md-4" style="margin-top: 10px;">
            <form action="#section6" class="form-horizontal formularz" role="form" method="POST">
                <div class="form-group">
                    <label for="kwota">Podaj kwotę kredytu</label>
                    <input class="form-control" type="number" name="kwota" placeholder="Podaj wartość ..."  min="0" max="500 000 000"
                           value="<?Php echo $k ? $k : '' ?>">
                </div>


                <div class="form-group">
                    <label for="oprocentowanie">Podaj oprocentowanie w skali roku</label>
                    <input class="form-control" type="number" name="oprocentowanie" placeholder="Wartość w % ..."
                           min="0" max="100" value="<?Php echo $p ? $p : '' ?>">
                </div>


                <div class="form-group">
                    <label for="year">Okres spłaty</label>
                    Ilość lat <input type="number" name="year" size="4" style="width:60px"  min="0" max="100"
                                     value="<?Php echo $year ? $year : '' ?>">

                    Ilość miesięcy <input type="number" name="month" size="3" style="width:60px"  min="0" max="1200"
                                          value="<?Php echo $month ? $month : '' ?>">
                </div>

                <div class="form-group">
                    <label for="raty">Sposób spłaty </label><br>
                    <label class="radio-inline"><input type="radio" name="raty" value="rowne">Raty równe</label>
                    <label class="radio-inline"><input type="radio" name="raty" value="malejace">Raty
                        malejące</label>
                </div>






                <button type="submit" class="btn btn-primary btn-block" style="background-color: dimgray;"> O B L I C
                    Z
                </button>
                <div class="odstep" style="height: 5px;"></div>
                <div class="odstep" style="height: 5px; background-color: orangered;"></div>
            </form>
        </div>

        <div class="col-md-4" style="margin-top: 10px;"></div>
    </div>
        <div class="odstep" style="height: 10px;"></div>
    <div id="section6"></div>
    <br>

<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo '

         <div class="well well-lg anime" style="background-color: dimgray; color: white; text-align: center">';?><h3>PONIŻEJ PRZEDSTAWIAMY HARMONOGRAM SPŁAT<br></h3><h2><strong>  <a style="color:orangered;">W ROZBICIU NA ODSETKI I KAPITAŁ</a></strong><h2> <?php
          echo' </div>



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
                            $p = $i-1;
                            echo '<tr>
                                <td>' . "$i" . '</td>
                                <td>';
                                foreach($kredyt->kapitalTablica as $key => $value)
                                    if ($key == $p){
                                        echo number_format ( $value , $decimals = 2 , $dec_point = "." , $thousands_sep = " " )."";

                                    }
                            echo'</td>
                                 <td>';
                                foreach($kredyt->odsetkiTablica as $key => $value)
                                    if ($key == $p){
                                        echo number_format ( $value , $decimals = 2 , $dec_point = "." , $thousands_sep = " " )."";

                                    }
                            echo'</td>
                                 <td>';
                                foreach($kredyt->splaty as $key => $value)
                                    if ($key == $p){
                                        echo number_format ( $value , $decimals = 2 , $dec_point = "." , $thousands_sep = " " )."";

                                    }
                            echo'</td>

                            </tr>
                            ';}
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

