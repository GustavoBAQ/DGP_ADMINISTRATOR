<?php
include('../verifica-login.php');
include('../conexao.php');
$active = "RH";
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
          
    
          <h2 class="pt-3">Recursos Humanos</h2>
          <a href="registro.php" class="btn btn-dark btn-sm" >
          <span data-feather="plus" class="align-text-bottom"></span>Novo
          </a>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">##</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Idade</th>
                  <th scope="col">Endereço</th>
                  <th scope="col">Telefone</th>
                  <th scope="col">Email</th>
                  <th scope="col">CPF</th>
                  <th scope="col">RG</th>
                  <th scope="col">Carteira de trabalho</th>
                </tr>
              </thead>
              <tbody>
              <?php
            $sql = "
            SELECT  id_colaborador, nome, idade, endereco, email,  telefone,cpf, rg, carteira, fk_usuario
            FROM colaboradores
            ORDER BY nome
            ";
            
            $query = mysqli_query($conecta,$sql);
            
            
            While($result = mysqli_fetch_array($query)){
              echo"
              <tr>
                  <td>$result[id_colaborador]</td>
                  <td>$result[fk_usuario]</td>
                  <td>$result[nome]</td>
                  <td>$result[idade]</td>
                  <td>$result[endereco]</td>
                  <td>$result[telefone]</td>
                  <td>$result[email]</td>
                  <td>$result[cpf]</td>
                  <td>$result[rg]</td>
                  <td>$result[carteira]</td>
                  <td> 
                  <a href='registro.php?id=$result[id_colaborador]' class='btn btn-outline-secondary'>
                  <span data-feather='edit' class='align-text-bottom'></span></a>

                  <a class='btn btn-outline-secondary' href='remover.php?id=$result[id_colaborador]'>
                  <span data-feather='trash' class='align-text-bottom'></span></a>
                  </a>
                  
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
          <a class="btn btn-outline-secondary" href="../RH/indexinicial.php"> Voltar </a>
          </div>
        </main>
      </div>
    </div>
    
    
    <script src="../js/bootstrap.bundle.min.js" ></script>
         <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" ></script>
         
        <script src="../js/dashboard.js"></script>
    
    









<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>