<?php
include('verifica-login.php');
include('conexao.php');
$active = "home";
$UsuarioEmail  = $_SESSION['EmailUsuario'];
mysqli_query($conecta, "DELETE FROM recuperacao WHERE utilizador = '$UsuarioEmail' ");



?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Inicial</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
    

     /* body {
         background-color: #1c2130; 
    }  */

    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    hr {
        color: #fff;
        background-color: #fff;
        width: 100%;
    }

    .text--titulo {
        margin-top: 10px;
        color: #fff;
        padding-left: 20px;
    }

    .containner--titulo {
        padding-left: 20px;
    }

    /* Wather Wave animation */
    @import url(//fonts.googleapis.com/css?family=Lato:300:400);

    body {
        margin: 0;
    }

    h1 {
        font-family: 'Lato', sans-serif;
        font-weight: 300;
        letter-spacing: 2px;
        font-size: 48px;
    }

    p {
        font-family: 'Lato', sans-serif;
        letter-spacing: 1px;
        font-size: 14px;
        color: #333333;
    }

    .header {
        position: relative;
        text-align: center;
        background: #1c2130;
        color: white;
        padding: 0px;
    }

    .logo {
        width: 50px;
        fill: white;
        padding-right: 15px;
        display: inline-block;
        vertical-align: middle;
    }

    .inner-header {
        height: 65vh;
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .flex {
        /*Flexbox for containers*/
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        text-align: center;
    }

    .waves {
        position: relative;
        width: 100%;
        height: 15vh;
        margin-bottom: -7px;
        /*Fix for safari gap*/
        min-height: 100px;
        max-height: 150px;
    }

    .content {
        position: relative;
        height: 55vh;
        text-align: center;
        background-color: white;
    }

    /* Animation */

    .parallax>use {
        animation: move-forever 25s cubic-bezier(.55, .5, .45, .5) infinite;
    }

    .parallax>use:nth-child(1) {
        animation-delay: -2s;
        animation-duration: 7s;
    }

    .parallax>use:nth-child(2) {
        animation-delay: -3s;
        animation-duration: 10s;
    }

    .parallax>use:nth-child(3) {
        animation-delay: -4s;
        animation-duration: 13s;
    }

    .parallax>use:nth-child(4) {
        animation-delay: -5s;
        animation-duration: 20s;
    }

    @keyframes move-forever {
        0% {
            transform: translate3d(-90px, 0, 0);
        }

        100% {
            transform: translate3d(85px, 0, 0);
        }
    }

    /*Shrinking for mobile*/
    @media (max-width: 768px) {
        .waves {
            height: 40px;
            min-height: 40px;
        }

        .content {
            height: 82vh;
            display: flex;
            align-content: center;
            flex-direction: column-reverse;
            align-items: center;
            justify-content: space-around;
        }

        h1 {
            font-size: 24px;
        }
    }

    /* FIM WATER WHAVE  */
    </style>

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>

<body>

    <script>
        close()
    </script>

    <?php
    include('topo.php');
    
   
   ?>

    <div class="container-fluid">
        <div class="row" style="background-color: #1c2130;">
            <?php
                include('menu.php');
            ?>


            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-0 containner--titulo">
                <h1 class="text--titulo">BEM VINDO</h1>
               
                <h3 class="text--titulo">A nossa plataforma digital</h3>
                
                <div class="row mt-4 ">

                </div>


                <!--Hey! This is the original version
                  of Simple CSS Waves-->

                <div class="header">

                    <!--Content before waves-->



                    <!--Waves Container-->
                    <div>
                        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                            <defs>
                                <path id="gentle-wave"
                                    d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                            </defs>
                            <g class="parallax">
                                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                                <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                            </g>
                        </svg>
                    </div>
                    <!--Waves end-->

                </div>
                <!--Header ends-->

                <!--Content starts-->


                

            </main>
                   <!--Content ends-->
         </div>

















    </div>
    
    <script>
        function close(){
            window.close()
        }
    </script>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="dashboard.js"></script>
</body>

</html>




</body>

</html>