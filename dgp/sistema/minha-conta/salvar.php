<?php

include('../verifica-login.php');
include('../conexao.php');


// VERIFICA SE ESTA VINDO INFORMAÇÕES VIA POST 
if($_POST) {
   
    $id_usuario = trim($_POST['id_usuario']);
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha= trim($_POST['senha']);
    
    if(is_numeric($id_usuario)){
        
        if($_SESSION['UsuarioS'] == $_POST['senha']){
        $sql = "
        UPDATE usuarios SET
        id_usuario = '$id_usuario',
        nome ='$nome',
        email='$email'
        WHERE id_usuario = $id_usuario";
            
        
        $query = mysqli_query($conecta,$sql);
    }else if($_SESSION['UsuarioS'] != $_POST['senha']){
        $sql = "
        UPDATE usuarios SET
        id_usuario = '$id_usuario',
        nome ='$nome',
        email='$email',
        senha= SHA1('$senha')
        WHERE id_usuario = $id_usuario";   
         $query = mysqli_query($conecta,$sql);
    } 
}
    
    
    // var_dump($fk_usuario);
    // echo $sql;exit;


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