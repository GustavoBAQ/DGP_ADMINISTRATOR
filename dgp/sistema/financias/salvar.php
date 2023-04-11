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
    INSERT INTO profissoes_setores (id_colaborador , id_profissao , id_setor , periodo , data_inicio,  data_fim,
    salario, inss, convenio, vale_transporte, vale_refeicao  ) VALUES
    (
        '$id_colaborador',
        '$id_profissao',
        '$id_setor',
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
    $query = mysqli_query($conecta,$sql0);

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