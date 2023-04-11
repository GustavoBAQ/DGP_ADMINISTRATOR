<?php

include('../verifica-login.php');
include('../conexao.php');

// VERIFICA SE ESTA VINDO INFORMAÇÕES VIA POST 
if($_POST) {
    $id_profissao_setor = trim($_POST['id_profissao_setor']);
    $id_colaborador = trim($_POST['id_colaborador']);
    $id_profissao = trim ($_POST['id_profissao']);
    $id_setor = trim($_POST['id_setor']);
    $periodo = trim($_POST['periodo']);
    $data_inicio = trim($_POST['data_inicio']);
    $data_fim = trim($_POST['data_fim']);
   
    

    if(is_numeric($id_profissao_setor)){
        
        $sql = "
        UPDATE profissoes_setores SET
        id_colaborador = '$id_colaborador',
        id_profissao ='$id_profissao',
        id_setor = '$id_setor',
        periodo = '$periodo',
        data_inicio ='$data_inicio',
        data_fim ='$data_fim'
        
        WHERE id_profissao_setor = $id_profissao_setor
        ";
    } else {
    $sql = "
    INSERT INTO profissoes_setores (id_colaborador , id_profissao , id_setor , periodo , data_inicio, 
     data_fim ) VALUES
    (
        '$id_colaborador',
        '$id_profissao',
        '$id_setor',
        '$periodo',
        '$data_inicio',
        '$data_fim'
    
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
header('location:./');
exit;
?>