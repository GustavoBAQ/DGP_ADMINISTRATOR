<?php

include('../verifica-login.php');
include('../conexao.php');

if($_GET['id']) {
    
  $id_usuario =trim($_GET['id']);
   $sql = "
   SELECT id_usuario
   FROM usuarios
   WHERE id_usuario = $id_usuario
   ";
  
   $query = mysqli_query($conecta,$sql);
   
if(mysqli_num_rows($query) != 0) {
    
    $sql = "
    DELETE FROM usuarios
    WHERE id_usuario = $id_usuario
    ";
    $query = mysqli_query($conecta,$sql);

    if($query) {
        $_SESSION['tipo'] = 'alert-success';
        $_SESSION['mensagem'] = '<strong>Oba!</strong><br>Registro removido com sucesso!';
        $_SESSION['button_encerrar'] ="";
    } else {
        $_SESSION['tipo'] = 'alert-danger';
        $_SESSION['mensagem'] = '<strong>Ops!</strong><br>Falha ao tentar remover!';
        $_SESSION['button_encerrar'] ="";
    } 
}
else {
    $_SESSION['tipo'] = 'alert-danger';
    $_SESSION['mensagem'] = '<strong>Ops!</strong><br>O usuário não pode ser removido, verifique a atividade!';
    $_SESSION['button_encerrar'] ="";
}
}
header('location:./index.php');
exit;

?>