<?php

include('../verifica-login.php');
include('../conexao.php');


// $codigo = $_SESSION["id_usuario"];

//faz a consulta no banco de dados
// $consulta = mysqli_query($conecta, "SELECT id_usuario FROM usuarios WHERE id_usuario = $codigo");

// //retorna o dado
// $query = mysqli_fetch_object($consulta);



//atribui o valor do campo da tabela na variável. Era o que você queria



$active = "colaborador";
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

      label h6{
          padding-right: 10px;
          
      }

      .content--data_fim{
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
          
    
          <h2 class="pt-3">Área do colaborador</h2>

          
         
          
        <div class="table-responsive">
        <table class="table table-striped table-sm">
        <thead>
                <tr>
                  
                  <th scope="col">Data da entrada</th>
                  <th scope="col">Hora da entrada</th>
                  <th scope="col">Saida para intervalo</th>
                  <th scope="col">Retorno do intervalo</th>
                  <th scope="col">Saida</th>
                  <th scope="col">Faltas Justificadas</th>
                  
                </tr>
              </thead>
        

        
        <?php
        // var_dump($id_usuario);
    // Receber os dados do formulário
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    // var_dump($dados);

    // Acessa o IF quando existe a data inicial e data final
    
    ?>

    <!-- Formulário pesquisar entre datas -->
    <form method="POST" action="">
    <br><br>
        <?php
        
        // Manter os dados no campo
        
        $data_inicio = "";
        if (isset($dados['data_inicio'])) {
            $data_inicio = $dados['data_inicio'];
        }
        ?>
        <label><h6>Data de Inicio</h6></label>
        <input type="date" name="data_inicio" value="<?php echo $data_inicio; ?>">
        <br><br>

        <?php
        // Manter os dados no campo
        $data_final = "";
        if (isset($dados['data_final'])) {
            $data_final = $dados['data_final'];
        }
        ?>
        <label><h6 class="content--data_fim">Data de Final</h6></label>
        <input type="date" name="data_final" value="<?php echo $data_final; ?>">
        <br><br>

        <input class= "btn btn-secondary" type="submit" value="Pesquisar" name="PesqUsuario"><br><br>

    </form>

    <?php
    // print_r($_SESSION['UsuarioID']);
    // $id_usuario = $_SESSION['[UsuarioID'];
    // var_dump($id_usuario);
    // var_dump($_SESSION['id_usuario']);
    $usuario_id = $_SESSION['UsuarioID'];
    // var_dump($usuario_id);
 
    $PesqUsuario = filter_input(INPUT_POST, 'PesqUsuario' , FILTER_SANITIZE_STRING);


    // Acessa o IF quando o usuário clicar no botão pesquisar
    if ($PesqUsuario) {

        // QUERY sql para pesquisar entre datas
        $data_inicial = filter_input (INPUT_POST,  'data_inicio', FILTER_SANITIZE_STRING);
        $data_final = filter_input (INPUT_POST,  'data_final', FILTER_SANITIZE_STRING);
        
        $sql = "
        SELECT fk_id_usuario, DATE_FORMAT(data_entrada, '%d/%m/%Y') data_entrada, entrada, saida_intervalo, retorno_intervalo,  saida
        FROM temporizadores
        WHERE data_entrada BETWEEN '$data_inicial' AND '$data_final' AND fk_id_usuario = $usuario_id
        ORDER BY data_entrada DESC
        ";

        $sql_second = "
        SELECT fk_id_usuario, DATE_FORMAT(data_entrada, '%d/%m/%Y') data_entrada , entrada, saida_intervalo, retorno_intervalo,  saida
        FROM temporizadores
        WHERE fk_id_usuario = $usuario_id
        ORDER BY data_entrada DESC
        ";

    
       

       
        


        
        // var_dump($sql);
        
        // Prepara a QUERY
        // $result_usuarios = $conecta->prepare($query_usuarios);
        // $result_usuarios = $conecta->prepare($query_usuarios);

        // Substitui os link da QUERY pelo valor
        // $result_usuarios->bindParam(':data_inicio', $dados['data_inicio']);
        // $result_usuarios->bindParam(':data_final', $dados['data_final']);
        // $result_usuarios->bind_param("sss", $data_inicio, $data_final);

        // $data_inicial = $dados['data_inicio'];
        // $data_final = $dados['data_final'];
     
    
        // Executar a QUERY
        $query = mysqli_query($conecta,$sql);   
        $query_second = mysqli_query($conecta,$sql_second);       
        // var_dump($query);

        // Acessa o IF quando encontrar registro no banco de dados
        if (($sql) and ($data_inicio > 0)){
        
          While($result = mysqli_fetch_array($query)){
              

              echo"
              <tr>
                  <td>$result[data_entrada]</td>
                  <td>$result[entrada]</td>
                  <td>$result[saida_intervalo]</td>
                  <td>$result[retorno_intervalo]</td>
                  <td>$result[saida]</td>
                  
                  <td> 
                  
                  
                  </td>
                </tr>
              ";
             }
  
        } else { // Acessa o ELSE quando não encontrar nenhum registro no banco de dados e imprime a mensagem de erro
          While($result = mysqli_fetch_array($query_second)){
              

            echo"
            <tr>
                <td>$result[data_entrada]</td>
                <td>$result[entrada]</td>
                <td>$result[saida_intervalo]</td>
                <td>$result[retorno_intervalo]</td>
                <td>$result[saida]</td>
                
                <td> 
                
                
                </td>
              </tr>
            ";
           }
          }
        }

    
    
    ?>
                
              </tbody>
            </table>
          </div>
          <div class="footer">
          <a class="btn btn-outline-secondary" href="../colaborador/index.php"> Voltar </a>
          </div>
        </main>
      </div>
    </div>
    
    
        <script src="../js/bootstrap.bundle.min.js" ></script>
         <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
         
        <script src="../js/dashboard.js"></script>
    
    









<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>