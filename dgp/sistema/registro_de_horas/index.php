<?php

include('../verifica-login.php');
include('../conexao.php');
$active = "Financeiro";

$data_inicial = date('Y-m-d', strtotime("-1 month", strtotime(date('Y-m-d'))));
$data_final = date('Y-m-d');
$where = "";

if(isset($_GET['fk_usuario'])) {
  $fk_usuario = $_GET['fk_usuario'];

  $where.= "
  AND fk_id_usuario = $fk_usuario
  ";

}

if(isset($_GET['data_inicial'])) {
  $data_inicial = $_GET['data_inicial'];

  $where.= "
  AND data_entrada >= '$data_inicial'
  ";

} 

if(isset($_GET['data_final'])) {
  $data_final = $_GET['data_final'];

  $where.= "
  AND data_entrada <= '$data_final'
  ";

}  else {
  $where.= "
  AND fk_id_usuario = 0
  ";
  
}

// $codigo = $_SESSION["id_usuario"];

//faz a consulta no banco de dados
// $consulta = mysqli_query($conecta, "SELECT id_usuario FROM usuarios WHERE id_usuario = $codigo");

// //retorna o dado
// $query = mysqli_fetch_object($consulta);



//atribui o valor do campo da tabela na variável. Era o que você queria










?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profissoes</title>
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

    label h6 {
        padding-right: 10px;

    }

    .content--data_fim {
        padding-right: 15px;
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
        <div class="row">
            <?php
        include('../menu.php');
        ?>



            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?php include('../alert.php');?>


                <h2 class="pt-3">Registro de Horas</h2>
                <br>
                <a href="registro.php" class="btn btn-dark btn-sm" >
          <span data-feather="plus" class="align-text-bottom"></span>Justificar Faltas
               </a>
               

                <div class="col-12">
<br>
                    <!-- Formulário pesquisar entre datas -->
                    <form class="row" action="">

                        <div class="col-md-6">
                            <label for="nome" class="form-label">
                                Colaborador:
                            </label>
                            <select required class="form-control" id="fk_usuario" name="fk_usuario">
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
          if($fk_usuario == $result1->id_usuario){
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
                        <div class="col-md-2">

                            <label>
                                <h6>Data de Inicio</h6>
                            </label>
                            <input class="form-control" type="date" name="data_inicial"
                                value="<?php echo $data_inicial; ?>">
                        </div>
                        <div class="col-md-2">
                            <label>
                                <h6 class="content--data_fim">Data de Final</h6>
                            </label>
                            <input class="form-control" type="date" name="data_final"
                                value="<?php echo $data_final; ?>">
                        </div>
                        <div class="col-md-2 mt-4">
                            <input class="btn btn-secondary" type="submit" value="Pesquisar" name="PesqUsuario">
                        </div>

                    </form>
                </div>


                <div class="table-responsive mt-3">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>

                                <th scope="col">Data da entrada</th>
                                <th scope="col">Hora da entrada</th>
                                <th scope="col">Saida para intervalo</th>
                                <th scope="col">Retorno do intervalo</th>
                                <th scope="col">Saida</th>
                                <th scope="col">Horas Trabalhadas</th>
                                <th scope="col">Faltas Justificadas</th>

                            </tr>
                        </thead>

                        <?php      
        $sql = "
        SELECT id_temporizador, fk_id_usuario, DATE_FORMAT(data_entrada, '%d/%m/%Y') data_entrada, entrada, saida_intervalo, retorno_intervalo,saida,total_hora,faltas_justificadas, 
        (
            SELECT CONCAT(
                SUM(HOUR(total_hora)) + FLOOR(SUM(MINUTE(total_hora))/60) ,
                ':' ,
                LPAD(SUM(MINUTE(total_hora))%60 + FLOOR(SUM(SECOND(total_hora))/60),2,0) ,
                ':' ,
                LPAD(SUM(SECOND(total_hora))%60,2,0)
            )
            FROM temporizadores t
            WHERE fk_id_usuario = temporizadores.fk_id_usuario
            AND data_entrada >= '$data_inicial'
            AND data_entrada <= '$data_final'
            GROUP BY fk_id_usuario
        ) horas_trabalhadas
        FROM temporizadores
        WHERE 1=1
        $where
        ORDER BY data_entrada ASC
        ";

        // echo $sql;exit;
              
        
      // $sql2 = "
      // UPDATE temporizadores SET
      // total_hora = sec_to_time(time_to_sec(TIMEDIFF(saida_intervalo, entrada)) + time_to_sec(timediff(saida , retorno_intervalo))) 
      // WHERE fk_id_usuario = $consult
      //   ";

        // Executar a QUERY
        $query = mysqli_query($conecta,$sql);   

        // Acessa o IF quando encontrar registro no banco de dados
        if (mysqli_num_rows($query) > 0){

          $horas = 0;
          $minutos = 0;
          $segundos = 0;
        
          while($result = mysqli_fetch_array($query)){

            $horas_trabalhadas = $result['horas_trabalhadas'];
              
            //   $horas = $horas + $result['horas'];
            //   $minutos = $minutos + $result['minutos'];
            //   $segundos = $segundos + $result['segundos'];

              echo "
              <tr>
                  <td>$result[data_entrada]</td>
                  <td>$result[entrada]</td>
                  <td>$result[saida_intervalo]</td>
                  <td>$result[retorno_intervalo]</td>
                  <td>$result[saida]</td>
                  <td>$result[total_hora]</td>
                  <td>$result[faltas_justificadas]</td>
                  <td>
                  <a href='registro.php?id=$result[id_temporizador]' class='btn btn-outline-secondary'>
                  <span data-feather='edit' class='align-text-bottom'></span></a>
                
                  </td>
                 
                </tr>
              ";
             }

            //  $segundos_2 = $segundos%60;
            //  $minutos = $minutos + floor($segundos / 60);
            //  $minutos_2 = $minutos%60;
            //  $horas = $horas + floor($minutos/60);

  
        }else{
         $horas_trabalhadas = '0:00:00';
//    $horas = 0;
//    $minutos = 0;
//    $segundos = 0;
//    $minutos_2 = 0;
//    $segundos_2 = 0;
        }
    
    ?>

                        </tbody>
                        <!-- <tfoot>
                            <tr>

                                <th scope="col"> </th>
                                <th scope="col"> </th>
                                <th scope="col"> </th>
                                <th scope="col"> </th>
                                <th scope="col"> </th>
                                <th scope="col"></th>
                                <th scope="col">Faltas Justificadas</th>

                            </tr>
                        </tfoot>
                    </table> -->
                </div>
                <div class="footer">
                    <a class="btn btn-outline-secondary" href="../Financeiro/index.php"> Voltar </a>
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











    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>