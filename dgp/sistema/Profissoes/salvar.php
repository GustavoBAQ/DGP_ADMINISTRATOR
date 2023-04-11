<?php

include('../verifica-login.php');
include('../conexao.php');

// VERIFICA SE ESTA VINDO INFORMAÇÕES VIA POST 
if($_POST) {
   
    $id_profissao = trim($_POST['id_profissao']);
    $nome_profissao = trim($_POST['nome_profissao']);
    $carga_hora = trim($_POST['carga_hora']);
    $descricao= trim($_POST['descricao']);

    if(is_numeric($id_profissao)){
        
        $sql = "
        UPDATE profissoes SET
        id_profissao = '$id_profissao',
        nome_profissao ='$nome_profissao',
        carga_hora='$carga_hora',
        descricao = '$descricao'
        WHERE id_profissao = $id_profissao
        
        ";
    } else {
    $sql = "
    INSERT INTO profissoes (id_profissao, nome_profissao, carga_hora , descricao) VALUES
    (
        '$id_profissao',
        '$nome_profissao',
        '$carga_hora',
        '$descricao'
        
       

    )
    ";
    }
    
    // echo $sql;exit;
    $query = mysqli_query($conecta,$sql);

    if($query) {
        $_SESSION['tipo'] = 'alert-success';
        $_SESSION['mensagem'] = '<strong>Oba!</strong><br>Registro salvo com sucesso!';
        $_SESSION['button_encerrar'] ="";
    } else {
        $_SESSION['tipo'] = 'alert-danger';
        $_SESSION['mensagem'] = '<strong>Ops!</strong><br>Falha ao tentar salvar!';
        $_SESSION['button_encerrar'] ="";
    }
}
header('location:./index.php');
exit;
?>