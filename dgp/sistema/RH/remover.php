<?php

include('../verifica-login.php');
include('../conexao.php');

if($_GET['id']) {
    
  $id_colaborador =trim($_GET['id']);
   $sql = "
   SELECT id_profissao_setor
   FROM profissoes_setores
   WHERE id_colaborador = $id_colaborador
   ";
  
   $query = mysqli_query($conecta,$sql);
   
if(mysqli_num_rows($query) == 0) {
   
    $sql = "
    DELETE FROM colaboradores
    WHERE id_colaborador = $id_colaborador
    ";
    $query = mysqli_query($conecta,$sql);

    if($query) {
        $_SESSION['tipo'] = 'alert-success';
        $_SESSION['button_encerrar'] ="";
        $_SESSION['mensagem'] = '<strong>Oba!</strong><br>Registro removido com sucesso!';
    } else {
        $_SESSION['tipo'] = 'alert-danger';
        $_SESSION['mensagem'] = '<strong>Ops!</strong><br>Falha ao tentar remover!';
        $_SESSION['button_encerrar'] ="";
    } 
    
}
else {
    $_SESSION['tipo'] = 'alert-danger';
    $_SESSION['mensagem'] = '<strong>Ops!</strong><br>O colaborador possue um registro ainda em andamento!';
    $_SESSION['button_encerrar'] ="";
    
}
}
header('location:./index.php');
exit;

?>