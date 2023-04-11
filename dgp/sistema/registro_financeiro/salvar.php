<?php

include('../verifica-login.php');
include('../conexao.php');

// VERIFICA SE ESTA VINDO INFORMAÇÕES VIA POST 







if($_POST) {
    $id_profissao_setor = trim($_POST['id_profissao_setor']);
   
    $salario = str_replace(',','.',trim($_POST['salario']));
    $inss = str_replace(',','.',trim($_POST['inss']));
    $convenio = str_replace(',','.',trim($_POST['convenio']));
    $vale_transporte =str_replace(',','.', trim($_POST['vale_transporte']));
    $vale_refeicao = str_replace(',','.',trim($_POST['vale_refeicao']));
   
    
   
    if(is_numeric($id_profissao_setor)){
        
        $sql = "
        UPDATE profissoes_setores SET
        salario ='$salario',
        inss ='$inss',
        convenio ='$convenio',
        vale_transporte ='$vale_transporte',
        vale_refeicao ='$vale_refeicao'
        WHERE id_profissao_setor = $id_profissao_setor
        ";

       
       
       
    } else {
    $sql = "
    INSERT INTO profissoes_setores ( salario, inss, convenio, vale_transporte, vale_refeicao  ) VALUES
    (
        
        '$salario',
        '$inss',
        '$convenio',
        '$vale_transporte',
        '$vale_refeicao'
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