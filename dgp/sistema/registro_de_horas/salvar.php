<?php

include('../verifica-login.php');
include('../conexao.php');
$id_temporizador = $_POST['id_temporizador'];


if(is_numeric($id_temporizador)){


    // VERIFICA SE ESTA VINDO INFORMAÇÕES VIA POST 
$faltas_justificadas = trim($_POST['faltas_justificadas']);


 $sql = "
    UPDATE temporizadores SET
    faltas_justificadas = '$faltas_justificadas'
    WHERE id_temporizador = '$id_temporizador'
    ";

    
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

else{

    // VERIFICA SE ESTA VINDO INFORMAÇÕES VIA POST 
    $fk_id_usuario = trim($_POST['fk_usuario']);
    $faltas_justificadas = trim($_POST['faltas_justificadas']);
    $data_entrada = trim($_POST['data_entrada']);
   
    $sql = "SELECT  * FROM temporizadores
    WHERE data_entrada = '$data_entrada'
    AND fk_id_usuario =  '$fk_id_usuario'
     ";
$query = mysqli_query($conecta,$sql);

if (mysqli_num_rows($query) > 0) {
    // ENCONTROU A DATA NO BANCO DE DADOS
    $_SESSION['tipo'] = 'alert-danger';
    $_SESSION['mensagem'] = '<strong>Ops!</strong><br>Esta data contem informações de horas!<br>Favor usar EDITAR.';

   
   
}
else {
    // NÃO ENCONTROU A DATA NO BANCO DE DADOS

     $sql = "

        INSERT INTO `temporizadores` (`faltas_justificadas`,`fk_id_usuario`, `data_entrada`) 
        VALUES (
      '$faltas_justificadas',
      '$fk_id_usuario',
      '$data_entrada'
      )
        ";
        
        $query = mysqli_query($conecta,$sql); 
   
        $_SESSION['tipo'] = 'alert-success';
        $_SESSION['mensagem'] = '<strong>Oba!</strong><br>Registro salvo com sucesso!';
       
    }}
    
    header('location:./');
    exit;


?>