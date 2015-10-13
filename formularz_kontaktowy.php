<?php
include_once('kredyt.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = ($_POST['Name']);
    $email = ($_POST['Email']);
    $message = ($_POST['Message']);



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
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
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
                <h1> Formularz <span style="color:orangered">kontaktowy </span>
            </div>
        </div>
    </div>

    <!-- <div class="row">
         <div class="col-md-3"></div>
         <div class="col-md-6 tlowstepu">-->
    <?php
    /*if($_SERVER['REQUEST_METHOD'] === 'POST' && $name=''){
        echo '<div class="form-group" style="text-align:center; padding:10px" >
                    <label for="comment" style = "color:white">Nie podałeś Nicku lub imienia, spróbuj jeszcze raz</label>
                    </div>';


    }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && $email=''){
        echo '<div class="form-group" style="text-align:center; padding:10px" >
                    <label for="comment" style = "color:white">Podałeś niepoprawny email spróbuj jeszcze raz</label>
                    </div>';

    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && $message=''){
        echo '<div class="form-group" style="text-align:center; padding:10px" >
                    <label for="comment" style = "color:white">Nie podałeś treści wiadomości, spróbuj jeszcze raz</label>
                    </div>';

    }*/


    // var_dump($email);echo'<br>';
    // var_dump($message);echo'<br>';
    //  var_dump($name);echo'<br>';

    //  echo '<div class="form-group" style="text-align:center; padding:10px" >
    //           <label for="comment" style = "color:white">Dziękujemy za przesłanie wiadomości</label>
    //           </div>';


    ?>
    <!--  </div>
      <div class="col-md-3"></div>
  </div>
  <div style="height:30px"></div>-->
    <form action="formularz_kontaktowy.php" method="post" class="anime">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 ">

                <div class="tlowstepu">


                    <div class="form-group">
                        <label for="comment" style="color:white">


                            <?php
                                if ($_SERVER['REQUEST_METHOD'] === 'POST' && $name!='' && $email!='' && $message!='') {
                                mail('tomasz@kawalkowski.pl', "$email", "$message", "$name", "-f tomasz@kawalkowski.pl");
                                echo "Dziękujemy za przesłanie wiadomości";
                                }
                                elseif(($_SERVER['REQUEST_METHOD'] === 'POST' && $name=='')){
                                    echo "Nie podałeś Nicku lub imienia i nazwiska";
                                }
                                elseif(($_SERVER['REQUEST_METHOD'] === 'POST' && $message=='')){
                                    echo "Pole wiadomości jest puste";
                                }

                            ?>

                        </label>
                        <input class="form-control" type="text" name="Name" placeholder="Nick lub Imię Nazwisko"
                               value="<?Php echo $name ? $name : '' ?>">

                        <div class="odstep" style="height: 10px;"></div>
                        <input class="form-control" type="email" name="Email" placeholder="Podaj swój email"
                               value="<?Php echo $email ? $email : '' ?>">

                        <div class="odstep" style="height: 10px;"></div>

                            <textarea class="form-control" rows="5" name="Message" id="comment"
                                      placeholder="Treść wiadomości"
                                      value= <?Php echo $message ? $message : '' ?>></textarea>

                        <div class="odstep" style="height: 20px;"></div>
                        <input type="submit" class="btn btn-info" style="width:100%">
                    </div>

                </div>
            </div>

            <div class="col-md-3"></div>
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

