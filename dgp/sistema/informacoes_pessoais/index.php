<?php
include('../verifica-login.php');
include('../conexao.php');

$id_usuario = $_SESSION['UsuarioID'];
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
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
$sql = "SELECT c.nome nome_colaborador , 
se.nome_setor, se.descricao setor_descricao, 
pr.nome_profissao,pr.descricao profissao_descricao, 
p.periodo
FROM usuarios s
JOIN colaboradores c ON c.fk_usuario = s.id_usuario
JOIN profissoes_setores p ON p.id_colaborador = c.id_colaborador
JOIN setores se ON se.id_setor = p.id_setor
JOIN profissoes pr ON pr.id_profissao = p.id_profissao
WHERE id_usuario = '$id_usuario'
";

$query = mysqli_query($conecta, $sql);

$result = mysqli_fetch_array($query);


?>
    
<?php
    include('../topo.php');
    ?>
    
    <div class="container-fluid">
      <div class="row">
        <?php
        include('../menu.php');

        
        ?>
    
    
    
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="body">

        <table class="table mt-5">
  
  <tbody>
    <tr>
      <th scope="row">Empresa:</th>
      <td>	Instituto Educacional Monte-Verde</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
    <th scope="row">Nome:</th>
      <td><?php echo $result['nome_colaborador'];?></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">Turno:</th>
      <td colspan=""><?php if($result['periodo'] == "T"){echo "Tarde";}else if($result['periodo'] == "M"){echo "Manhã";}else{echo "Noite";}?></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">Profissão:</th>
      <td colspan=""><?php echo $result['nome_profissao']?></td>
      <td><?php echo $result['profissao_descricao']?></td>
      <td></td>
    </tr>

    <tr>
      <th scope="row">Setor:</th>
      <td colspan=""><?php echo $result['nome_setor']?></td>
      <td><?php echo $result['setor_descricao']?></td>
      <td></td>
    </tr>
    
  </tbody>
</table>
        


        </div>

          
          <div class="footer mt-4">
          <a class="btn btn-outline-secondary" href="../colaborador/index.php"> Voltar </a>
          </div>
        </main>
      </div>
    </div>
    
    <script src="../js/bootstrap.bundle.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
<script src="../js/dashboard.js"></script>
</body>
</html>