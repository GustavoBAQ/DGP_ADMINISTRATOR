<?php
include('../verifica-login.php');
include('../conexao.php');
$active = "RH";

if(isset($_GET['id'])){
  $id_profissao_setor = trim($_GET['id']);
 
  $sql = "
  SELECT *
  FROM profissoes_setores
  WHERE id_profissao_setor = $id_profissao_setor
  ";
  $query = mysqli_query($conecta,$sql);
  $result = mysqli_fetch_object($query);

  $id_profissao_setor = $result -> id_profissao_setor;
  $id_colaborador = $result -> id_colaborador;
  $id_profissao = $result -> id_profissao;
  $id_setor = $result -> id_setor;
  $periodo = $result -> periodo;
  $data_inicio = $result -> data_inicio;
  $data_fim = $result -> data_fim;
  $salario = $result -> salario;
  $salario = number_format($salario,2,',','.');
  $inss = $result-> inss;
  $inss = number_format($inss,2,',','.');
  $convenio = $result-> convenio;
  $convenio = number_format($convenio,2,',','.');
  $vale_transporte = $result-> vale_transporte;
  $vale_transporte = number_format($vale_transporte,2,',','.');
  $vale_refeicao = $result-> vale_refeicao;
  $vale_refeicao = number_format($vale_refeicao,2,',','.');
 
} else {
  $id_profissao_setor = ' ';
  $nome_colaborador = ' ';
  $nome_profissao = ' ';
  $nome_setor = ' ';
  $periodo = ' ';
  $data_inicio = ' ';
  $data_fim = ' ';
  $salario = ' ';
  $inss = ' ';
  $covenio = ' ';
  $vale_transporte = ' ';
  $vale_refeicao = ' ';

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
     <strong>INFORMAÇÕES DO CADASTRO</strong>
     </div>
     <div class="card-body">
    <!-- formulario  -->
    <div class="row g-3">
    <div class="col-md-6">
        <label for="nome" class="form-label">
            Nome do Colaborador:
    </label>
        <select class="form-control"  id="id_colaborador" name="id_colaborador" >
        <option value="">-- Selecione --</option>
        <?php
        $sql0 = "
        SELECT id_colaborador , nome
        FROM colaboradores
        ORDER BY nome
        ";
        $query0 = mysqli_query($conecta,$sql0);
        while($result1 = mysqli_fetch_object($query0)){
          $selected = "";
          if($result->id_colaborador == $result1->id_colaborador){
            $selected = "selected";
          }
          echo '
          <option '.$selected.' value="'.$result1->id_colaborador.'"> '.$result1->nome.' </option>
          ';
        }
        ?>
    </select>
    
    </div>
    <div class="col-md-6">
        <label for="profissao" class="form-label">
            Nome da Ocupação:
    </label>
        <select class="form-control"  id="id_profissao" name="id_profissao" >
        <option value="">-- Selecione --</option>
        <?php
        $sql0 = "
        SELECT id_profissao , nome_profissao
        FROM profissoes
        ORDER BY nome_profissao
        ";
        $query0 = mysqli_query($conecta,$sql0);
        while($result1 = mysqli_fetch_object($query0)){
          $selected = "";
          if($result->id_profissao == $result1->id_profissao){
            $selected = "selected";
          }
          echo '
          <option '.$selected.' value="'.$result1->id_profissao.'"> '.$result1->nome_profissao.' </option>
          ';
        }
        ?>
    </select>
    
    </div>
    
    <div class="col-md-4">
        <label for="profissao" class="form-label">
            Nome do Setor:
    </label>
        <select class="form-control"  id="id_setor" name="id_setor" >
        <option value="">-- Selecione --</option>
        <?php
        $sql0 = "
        SELECT id_setor , nome_setor
        FROM setores
        ORDER BY nome_setor
        ";
        $query0 = mysqli_query($conecta,$sql0);
        while($result1 = mysqli_fetch_object($query0)){
          $selected = "";
          if($result->id_setor == $result1->id_setor){
            $selected = "selected";
          }
          echo '
          <option '.$selected.' value="'.$result1->id_setor.'"> '.$result1->nome_setor.' </option>
          ';
        }
        ?>
    </select>
    </div>

    <div class="col-md-2">
        <label for="periodo" class="form-label">
            Periodo:
    </label>
    <select class="form-control"  id="periodo" name="periodo" value="">
        <option value="">-- selecione --</option>
        <option value="M" <?php echo $periodo == 'M' ? 'selected' : ''; ?>>Manhã</option>
        <option value="T" <?php echo $periodo == 'T' ? 'selected' : ''; ?>>Tarde</option>
        <option value="N" <?php echo $periodo == 'N' ? 'selected' : ''; ?>>Noite</option>
    </select>
    </div>

    <div class="col-md-3">
        <label for="data_inicio" class="form-label">
            Data Inicial:
    </label>
    <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="<?php echo $data_inicio; ?>">
    </div>

    <div class="col-md-3">
        <label for="data_fim" class="form-label">
            Data Final:
    </label>
    <input type="date" class="form-control" id="data_fim" name="data_fim" value="<?php echo $data_fim; ?>">
    </div>

   
    
    


     </div>
     </div>
     <div class="card-footer">
     <!-- botões de salvar e cancelar  -->
     <input  type="hidden" id="id_profissao_setor" name="id_profissao_setor" value= "<?php echo $id_profissao_setor?>">
     <a class="btn btn-outline-secondary" href="./"> Voltar </a>
     <button type="submit" class="btn btn-primary"> Salvar </button>
    </div>
    </form>

     </div>
    </main>
  </div>
</div>

<script src="../js/bootstrap.bundle.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
<script src="../js/dashboard.js"></script>

</html>

</body>
</html>