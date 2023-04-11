<?php
include('../verifica-login.php');
include('../conexao.php');
$active = "itemporizadores";


if(isset($_GET['id'])){
  
  $id_temporizador = trim($_GET['id']);
  $disabled = "disabled";
  
  $sql = "
  SELECT *
  FROM temporizadores
  WHERE id_temporizador = $id_temporizador
  ";
  $query = mysqli_query($conecta,$sql);
  $result = mysqli_fetch_object($query);

  $id_temporizador = $result -> id_temporizador;
  $data_entrada = $result -> data_entrada;
  $entrada = $result -> entrada;
  $saida_intervalo = $result -> saida_intervalo;
  $retorno_intervalo = $result -> retorno_intervalo;
  $saida = $result -> saida;
  $fk_id_usuario = $result -> fk_id_usuario;
  $faltas_justificadas = $result -> faltas_justificadas;
  $faltas = $result -> faltas;
  
} else {
  $data_entrada = '';
  $entrada = '';
  $saida_intervalo = '';
  $retorno_intervalo = '';
  $saida = '';
  $faltas = '';
  $disabled = '';
 
 
}

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
    </style>


    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
</head>





<body>

    <body>

        <?php
include('../topo.php');
?>

        <div class="container-fluid">
            <div class="row">
                <?php
include('../menu.php');
?>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="card mt-4">
                        <form method="post" action="salvar.php">

                            <div class="card-header">
                                <!-- titulo do card   -->
                                <strong>Registro de Horas</strong>
                            </div>
                            <div class="card-body">
                                <!-- formulario  -->
                                <div class="row g-3">
                                <div class="col-md-6">
                            <label for="nome" class="form-label">
                                Colaborador:
                            </label>
                            <select   required class="form-control" id="fk_usuario" name="fk_usuario" <?php echo $disabled; ?>>
                                <option value="">-- Selecione --</option>
                                <?php
        $sql0 = "
        SELECT id_usuario , u.nome  
        FROM usuarios u 
        ORDER BY nome
        ";
        $query3 = mysqli_query($conecta,$sql0);
        while($result1 = mysqli_fetch_object($query3)){
          
          $selected = "";
          if($fk_id_usuario == $result1->id_usuario){
            $selected = "selected";
          }
          echo '
          <option '.$selected.' value="'.$result1->id_usuario.'"> '.$result1->nome.' </option>
          ';
          $consult=$result1->id_usuario;
        }
        ?>
                            </select>
                        </div>
                                    <div class="col-md-6">
                                        <label for="data_entrada" class="form-label">
                                            Data da Falta:
                                        </label>
                                        <input require type="date" class="form-control" id="data_entrada" name="data_entrada" 
                                            value="<?php echo $data_entrada; ?>" <?php echo $disabled ;?>>
                                    </div>
                                   
                                    <div class="col-md-6">
                                        <label for="saida" class="form-label">Horas Justificadas :

                                        </label>
                                        <input type="time" class="form-control" id="faltas_justificadas"
                                            name="faltas_justificadas" value="<?php echo $faltas_justificadas; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <!-- botões de salvar e cancelar  -->
                                <input type="hidden" id="id_temporizador" name="id_temporizador"
                                    value="<?php echo $id_temporizador?>">
                                <a class="btn btn-outline-secondary" href="./"> Voltar </a>
                                <button type="submit" class="btn btn-primary"> Salvar </button>
                            </div>
                        </form>

                    </div>
                </main>
            </div>
        </div>

        <script src="../js/bootstrap.bundle.min.js"
            >
        </script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
           >
        </script>
        <script src="../js/dashboard.js"></script>

</html>

</body>

</html>