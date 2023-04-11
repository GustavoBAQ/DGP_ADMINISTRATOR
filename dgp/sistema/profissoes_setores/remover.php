<?php

include('../verifica-login.php');
include('../conexao.php');

if($_GET['id']) {
    
  $id_profissao_setor =trim($_GET['id']);
   $sql = "
   SELECT id_profissao_setor
   FROM profissoes_setores
   WHERE id_profissao_setor = $id_profissao_setor
   AND data_fim > CURDATE()
   ";
   $query = mysqli_query($conecta,$sql);
   
if(mysqli_num_rows($query) == 0) {
    
    $sql = "
    DELETE FROM profissoes_setores
    WHERE id_profissao_setor = $id_profissao_setor
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
    $_SESSION['mensagem'] = '<strong>Ops!</strong><br>Colaborador ainda possue tempo de contrato!';
    $_SESSION['button_encerrar'] ="";
}
}
header('location:./');
exit;

?>