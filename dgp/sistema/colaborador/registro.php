<?php
include('../verifica-login.php');
include('../conexao.php');
$active = "Matriculas";

if(isset($_GET['id'])){
  $id_matricula = trim($_GET['id']);
 
  $sql = "
  SELECT *
  FROM matriculas
  WHERE id_matricula = $id_matricula
  
            
  ";
  $query = mysqli_query($conecta,$sql);
  $result = mysqli_fetch_object($query);

  $id_aluno= $result -> id_aluno;
  $id_turma = $result -> id_turma;
  


} else {
  $id_aluno = '';
  $id_turma = '';
  
  

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
     <strong>INFORMAÇÕES DO MATRICULA</strong>
     </div>
     <div class="card-body">
    <!-- formulario  -->
    <div class="row g-3">
    <div class="col-md-6">
        <label for="nome" class="form-label">
            nome do aluno:
    </label>
        <select class="form-control"  id="id_aluno" name="id_aluno" >
        <option value="">-- Selecione --</option>
        <?php
        $sql0 = "
        SELECT id_aluno , nome
        FROM alunos 
        ORDER BY nome
        ";
        $query0 = mysqli_query($conecta,$sql0);
        while($result1 = mysqli_fetch_object($query0)){
          $selected = "";
          if($result->id_aluno == $result1->id_aluno){
            $selected = "selected";
          }
          echo '
          <option '.$selected.' value="'.$result1->id_aluno.'"> '.$result1->nome.' </option>
          ';
        }
        ?>
    </select>
    
    </div>
    
    <div class="col-md-6">
        <label for="turma" class="form-label">
            Turma
    </label>
    <select class="form-control"  id="id_turma" name="id_turma" >
        <option value="">-- Selecione --</option>
        <?php
        $sql0 = "
        SELECT id_turma ,CONCAT(LPAD(t.id_turma,5,0) ,' - ', c.nome) nome_curso
        FROM turmas t
        JOIN cursos c ON c.id_curso = t.id_curso

        ORDER BY id_turma
        ";
        $query0 = mysqli_query($conecta,$sql0);
        while($result0 = mysqli_fetch_object($query0)){
          $selected = "";
          if($result->id_turma == $result0->id_turma){
            $selected = "selected";
          }
          echo '
          <option '.$selected.' value="'.$result0->id_turma.'"> '.$result0->nome_curso.' </option>
          ';
        }
        ?>
        </select>
    
        </div>
      </div>
    
    </div>
     <div class="card-footer">
     <!-- botões de salvar e cancelar  -->
     <input  type="hidden" id="id_matricula" name="id_matricula" value= "<?php echo $id_matricula?>">
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