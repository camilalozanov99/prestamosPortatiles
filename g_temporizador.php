<?php
  require('func_temporizador.php');
?>

<!DOCTYPE HTML>
<html>
    <head>

        <title>Préstamo de portátiles - UNINORTE</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet">

        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">

        <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

        <!-- Theme Style -->
        <link rel="stylesheet" href="css/style.css">

            <style>
                p {
                text-align: center;
                border-radius: 15px !important;
                font-size: 30px !important;
                font-weight: 266.6 !important;
                position: absolute !important;
                top: 70px;
                left: 0px !important;
                width: 200px !important;
                }
                .p1 {
                font-size: 12px !important;
                text-align: center !important;
                font-weight: 266.6 !important;
                position: absolute !important;
                top: 0px !important;
                width: 200px !important;
                }
            </style>
            
        </link>

    </head>

    <!--Just an image-->
    
    <!--<section class="site-hero site-sm-hero overlay" data-stellar-background-ratio="0.5"
            style="background-image: url(res.JPG);">
    </section>-->

    <body>

        <header role="banner">

            <!--<nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="icono-lap">
                <h5 class="navbar-brand absolute" href="index.html">Préstamo de portátiles - UN</h5>                         
                <span class="ion-android-laptop"></span>
                <br>
                </div>         
            </nav>-->

        </header>           
        <div style="height:5px;">&nbsp;</div>
        <div class="timer-group">
            <div class="timer hour">
                <div class="hand"><span></span></div>
                <div class="hand"><span></span></div>
            </div>
            <div class="timer minute">
                <div class="hand"><span></span></div>
                <div class="hand"><span></span></div>
            </div>
            <div class="timer second">
                <div class="hand"><span></span></div>
                <div class="hand"><span></span></div>
            </div>
            <div class="face">
                <p id="demo"></p> 
            </div>
        </div>

        <?php
        //print_r("working");
        $tiempos = ejecutar();
        foreach($tiempos as $row){ 
         $mes = substr($row['FECHA_VENCIMIENTO'],3,2); 
         //print_r($mes);
         $dia = substr($row['FECHA_VENCIMIENTO'],0,2); 
         //print_r($dia);
         $anno = substr($row['FECHA_VENCIMIENTO'],6,4); 
         //print_r($anno);
         $hora = substr($row['HORA_VENCIMIENTO'],0,2); 
         //print_r($hora);
         $minuto = substr($row['HORA_VENCIMIENTO'],3,2); 
         //print_r($minuto);
         $tiempo = $mes."/".$dia."/".$anno." ".$hora.":".$minuto.":00";
         //print_r($tiempo);
        }
        ?>   
        

        <script>
        
            //pasar variable a js

            var tiempojs ='<?php echo $tiempo;?>';

            //document.write(tiempojs+"tiempojs");

            // Set the date we're counting down to
            var countDownDate = new Date(tiempojs).getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();
                
            // Find the distance between now and the count down date
            var distance = countDownDate - now;
                
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
            // Output the result in an element with id="demo"
            if(hours!=0){
                document.getElementById("demo").innerHTML = hours + "h "
                + minutes + "m " + seconds + "s ";
            }
            else{
                    document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";
            }
            
                
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "¡Tienes multa!";
            }
            }, 1000);
        </script>

        <div class="site-section bg-light">            
            <div class="aligncenter"> 

                <?php
                    $elem = ejecutar();
                    foreach($elem as $row){                 
                        echo'<div class="row1">';
                            echo'<div class="col-12">';
                                echo'<div class="card-deck">';
                                    echo'<div class="card">';
                                        echo'<img class="card-img-top img-adjusted">';
                                        echo'<div class="card-body">';
                                            echo'<div id="textbox">';
                                                echo'<h5 class="alignleft" class="card-title" >';
                                                    echo "Entrega el portátil antes de:";
                                                echo'</h5> <!--Nombre de la sala-->';                                                    
                                            echo'</div>';
                                            echo '<div class="aligncenter" style="height:20px;">&nbsp;</div>';
                                            echo'<p class="p1">';
                                                echo '<div style="height:5px;">&nbsp;</div>';
                                                echo $row['HORA_VENCIMIENTO']; //hora para entregar pc
                                            echo'</p> <!--Bloque en el que se encuentra la sala-->';
                                            echo'<div class="puntos"></div>';
                                        echo'</div>';
                                    echo'</div>';
                                echo'</div>';
                            echo'</div>';
                        echo'</div>';

                        echo'<div class="row1">';
                        echo'<div class="col-12">';
                            echo'<div class="card-deck">';
                                echo'<div class="card">';
                                    echo'<img class="card-img-top img-adjusted">';
                                    echo'<div class="card-body">';
                                        echo'<div id="textbox">';
                                            echo'<h5 class="alignleft" class="card-title" >';
                                                echo "Entrega el portátil en:"; 
                                            echo'</h5> <!--Nombre de la sala-->';                                                    
                                        echo'</div>';
                                        echo '<div style="height:20px;">&nbsp;</div>';
                                        echo'<p class="p1">';
                                            echo '<div style="height:5px;">&nbsp;</div>';
                                            echo $row['UBICACION']; //sala para entregar pc
                                        echo'</p> <!--Bloque en el que se encuentra la sala-->';
                                        echo'<div class="puntos"></div>';
                                        echo '<div style="height:30px;">&nbsp;</div>';
                                    echo'</div>';
                                echo'</div>';
                            echo'</div>';
                        echo'</div>';
                    echo'</div>';
                    print_r($user);
                    }
                ?>

            </div>
        </div>

        
    </body>
</html> 