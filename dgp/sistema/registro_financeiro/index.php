<?php
include('../verifica-login.php');
include('../conexao.php');
$active = "Financeiro";
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
          
    
          <h2 class="pt-3">Cadastro Financeiro</h2>
          <br>
          
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Colaborador</th>
                  <th scope="col">Profissão</th>
                  <th scope="col">Setores</th>
                  <th scope="col">Salario por hora</th>
                  <th scope="col">INSS</th>
                  <th scope="col">Convenio</th>
                  <th scope="col">Vale Transporte</th>
                  <th scope="col">Vale Refeição</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
              <?php
            $sql = "
            SELECT m.id_profissao_setor , c.nome nome_colaborador , p.nome_profissao nome_profissao, s.nome_setor nome_setor ,
             m.periodo, m.data_inicio, m.data_fim, m.salario, m.inss, m.convenio, m.vale_transporte, m.vale_refeicao
            
            FROM profissoes_setores m
            JOIN colaboradores c ON m.id_colaborador = c.id_colaborador
            JOIN profissoes p ON p.id_profissao = m.id_profissao
            JOIN setores s ON m.id_setor = s.id_setor
            WHERE m.id_profissao_setor 
            ORDER BY nome_colaborador;
            ";
            $querry = mysqli_query($conecta,$sql);
            
            While($result = mysqli_fetch_array($querry)){
              echo"
              <tr>
                  <td>$result[id_profissao_setor]</td>
                  <td>$result[nome_colaborador]</td>
                  <td>$result[nome_profissao]</td>
                  <td>$result[nome_setor]</td>
                  <td>$result[salario]</td>
                  <td>$result[inss]</td>
                  <td>$result[convenio]</td>
                  <td>$result[vale_transporte]</td>
                  <td>$result[vale_refeicao]</td>
                  
                  <td> 
                  <a href='registro.php?id=$result[id_profissao_setor]' class='btn btn-outline-secondary'>
                  <span data-feather='edit' class='align-text-bottom'></span></a>

                  
                  
                  </td>
                </tr>
              ";
            // While($result = mysqli_fetch_array($querry)){
            //   echo"
            //   <tr>
            //       <td>$result[id_matricula]</td>
            //       <td>$result[data_matricula]</td>
            //       <td>$result[nome_aluno]</td>
            //       <td>$result[nome_curso]</td>
            //       <td>$result[periodo]</td>
            //     </tr>
            //   ";
            }

            
            ?>
                
              </tbody>
            </table>
          </div>
          <div class="footer">
          <a class="btn btn-outline-secondary" href="../Financeiro/index.php"> Voltar </a>
          </div>
        </main>
      </div>
    </div>
    
    
        <script src="/dgp/sistema/js/bootstrap.bundle.min.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" ></script>
         
        <script src="/dgp/sistema/js/dashboard.js"></script>
    
    









<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>