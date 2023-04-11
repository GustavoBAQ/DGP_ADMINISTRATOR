<?php

include('../verifica-login.php');
include('../conexao.php');

if($_GET['id']) {
    
  $id_matricula =trim($_GET['id']);
   $sql = "
   SELECT m.id_matricula
   FROM matriculas m
   JOIN turmas t ON m.id_turma = t.id_turma
    WHERE id_matricula = $id_matricula
    AND t.data_termino <CURDATE()
   ";
   $query = mysqli_query($conecta,$sql);
   
if(mysqli_num_rows($query) == 0) {
    
    $sql = "
    DELETE FROM matriculas
    WHERE id_matricula = $id_matricula
    ";
    $query = mysqli_query($conecta,$sql);

    if($query) {
        $_SESSION['tipo'] = 'alert-success';
        $_SESSION['mensagem'] = '<strong>Oba!</strong><br>Registro removido com sucesso!';
        $_SESSION['button_encerrar'] ="";
        
    } else{
        
        $_SESSION['tipo'] = 'alert-danger';
        $_SESSION['mensagem'] = '<strong>Ops!</strong><br>Falha ao tentar remover!';
        $_SESSION['button_encerrar'] ="";
    }
}
else {
    $_SESSION['tipo'] = 'alert-danger';
    $_SESSION['mensagem'] = '<strong>Ops!</strong><br> O curso ja foi encerrado não podera excluir esta Matricula!';
    $_SESSION['button_encerrar'] ="";
}
}
header('location:./');
exit;

?>