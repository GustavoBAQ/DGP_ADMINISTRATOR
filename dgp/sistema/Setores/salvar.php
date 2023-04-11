<?php

include('../verifica-login.php');
include('../conexao.php');

// VERIFICA SE ESTA VINDO INFORMAÇÕES VIA POST 
if($_POST) {
   
    $id_setor = trim($_POST['id_setor']);
    $nome_setor = trim($_POST['nome_setor']);
    $descricao = trim($_POST['descricao']);

    if(is_numeric($id_setor)){
        
        $sql = "
        UPDATE setores SET
        id_setor = '$id_setor',
        nome_setor ='$nome_setor',
        descricao='$descricao'
        WHERE id_setor = $id_setor
        ";
    } else {
    $sql = "
    INSERT INTO setores (id_setor, nome_setor , descricao  ) VALUES
    (
        '$id_setor',
        '$nome_setor',
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