<?php

include('../verifica-login.php');
include('../conexao.php');

// VERIFICA SE ESTA VINDO INFORMAÇÕES VIA POST 
if($_POST) {
    $id_matricula= trim($_POST['id_matricula']);
    $id_aluno = trim($_POST['id_aluno']);
    $id_turma = trim ($_POST['id_turma']);
    
    
    if(is_numeric($id_matricula)){
        
        $sql = "
        UPDATE matriculas SET
        id_aluno = '$id_aluno',
        id_turma ='$id_turma'

        
        WHERE id_matricula = $id_matricula
        ";
    } else {
    $sql = "
    INSERT INTO matriculas (id_aluno, id_turma , data_matricula ) VALUES
    (
        '$id_aluno',
        '$id_turma',
           NOW()
        
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