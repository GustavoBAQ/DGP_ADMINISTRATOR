<?php

include('../verifica-login.php');
include('../conexao.php');


// VERIFICA SE ESTA VINDO INFORMAÇÕES VIA POST 
if($_POST) {
   
    $id_colaborador = trim($_POST['id_colaborador']);
    $nome = trim($_POST['nome']);
    $idade = trim($_POST['idade']);
    $endereco= trim($_POST['endereco']);
    $telefone = trim ($_POST['telefone']);
    $email = trim ($_POST['email']);
    $cpf = trim ($_POST['cpf']);
    $rg = trim ($_POST['rg']);
    $carteira = trim ($_POST['carteira']);
    $fk_usuario = trim($_POST['fk_usuario']);
    if(is_numeric($id_colaborador)){
        
        $sql = "
        UPDATE colaboradores SET
        id_colaborador = '$id_colaborador',
        nome ='$nome',
        idade='$idade',
        endereco = '$endereco',
        telefone = '$telefone',
        email = '$email',
        cpf = '$cpf',
        rg = '$rg',
        carteira = '$carteira',
        fk_usuario = '$fk_usuario'
        WHERE id_colaborador = $id_colaborador
        
        ";
    } else {
    $sql = "
    INSERT INTO colaboradores (id_colaborador, nome , idade , endereco, telefone, email, cpf, rg, carteira, fk_usuario ) VALUES
    (
        '$id_colaborador',
        '$nome',
        '$idade',
        '$endereco',
        '$telefone',
        '$email',
        '$cpf',
        '$rg',
        '$carteira',
        '$fk_usuario'
        
       

    )
    ";
    }
    
    // var_dump($fk_usuario);
    // echo $sql;exit;
    $query = mysqli_query($conecta,$sql);

    if($query) {
        $_SESSION['tipo'] = 'alert-success';
        $_SESSION['mensagem'] = '<strong>Oba!</strong><br>Registro salvo com sucesso!';
        $_SESSION['button_encerrar'] ="";
    } else {
        $_SESSION['tipo'] = 'alert-danger';
        $_SESSION['mensagem'] = '<strong>Ops!</strong><br>Falha ao tentar salvar! Preencha todos os campos';
        $_SESSION['button_encerrar'] ="";
    }
}
header('location:./index.php');
exit;
?>