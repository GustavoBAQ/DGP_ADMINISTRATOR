<?php

include('../verifica-login.php');
include('../conexao.php');


// VERIFICA SE ESTA VINDO INFORMAÇÕES VIA POST 
if($_POST) {
   
    $id_usuario = trim($_POST['id_usuario']);
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = "Senha123";
    if(is_numeric($id_usuario)){
        
        $sql = "
        UPDATE usuarios SET
        id_usuario = '$id_usuario',
        nome ='$nome',
        email='$email',
       
        WHERE id_usuario = $id_usuario
        
        ";
    } else {
    $sql = "
    INSERT INTO usuarios (id_usuario, nome , email , senha) VALUES
    (
        '$id_usuario',
        '$nome',
        '$email',
        SHA1('$senha')
        
       

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
        $_SESSION['mensagem'] = '<strong>Ops!</strong><br>Falha ao tentar salvar!';
        $_SESSION['button_encerrar'] ="";
    }
}
header('location:./index.php');
exit;
?>