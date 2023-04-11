<?php
include('../verifica-login.php');
include('../conexao.php');
$active = "colaborador";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Inicial</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
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

    .row {

        padding: 0px;
        margin: 0px;
    }

    .header--topo {
        background: black;
        padding: 0px;
        margin: 0px;
    }

    .container-fluid {
        padding: 0px;
    }

    .text--titulo {
        margin-top: 10px;
        color: #fff;
    }

    h1 {
        font-family: 'Lato', sans-serif;
        font-weight: 300;
        letter-spacing: 2px;
        font-size: 48px;
    }

    .content {
        position: relative;
        height: 55vh;
        text-align: center;
        background-color: white;
    }

    .header {
        position: relative;
        text-align: center;
        background: #1c2130;
        color: white;
        padding: 0px;
    }

    .menu {
        justify-content: space-evenly;

    }

    .text-bg-danger {
        color: #000 !important;
        text-decoration: none;
        display: block;


    }

    .text-bg-success {
        color: #000 !important;
        text-decoration: none !important;
        display: block;


    }

    .card--item a:hover {
        text-decoration: none !important;

    }

    .card--item a {
        text-decoration: none !important;

    }
    </style>


    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
</head>





<body>



    <?php


    include('../topo.php');
    ?>

    <div class="container-fluid">
        <div class="row " style="background-color: #1c2130;">
            <?php
        include('../menu.php');
        ?>



            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h1 class="text--titulo">BEM VINDO</h1>
                <h3 class="text--titulo">Colaborador</h3>





            </main>
        </div>
        <div class="row mt-4 "></div>
        <div class="row col-md-9 ms-sm-auto col-lg-10 px-md-0 containner--titulo menu">


            <div class="col-md-3 card--item">
                <a href="/dgp/sistema/espelho_cartao/index.php">
                    <div class="card text-bg-success  mb-3">

                        <div class="card-body" type="button">
                            <h5 class="card-title">Espelho de Cartão</h5>
                            <p class="card-text">Informações sobre a jornada de trabalho</p>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 card--item">
                <a href="/dgp/sistema/honorarios/index.php">
                    <div class="card text-bg-warning  mb-3">

                        <div class="card-body" type="button">
                            
                            <h5 class="card-title">Honorários</h5>
                            <p class="card-text">Informações sobre holerite e bonificações </p>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 card--item">
                <a href="/dgp/sistema/informacoes_pessoais/index.php">
                    <div class="card text-bg-danger  mb-3">

                        <div class="card-body" type="button">
                            <h5 class="card-title">Informações Pessoais</h5>
                            <p class="card-text">Informações sobre sua área de ocupação </p>

                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>


    <script src="../js/bootstrap.bundle.min.js"
        >
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js">
    </script>














</body>

</html>