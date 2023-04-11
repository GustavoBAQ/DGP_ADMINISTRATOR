<?php
session_start();
if($_SESSION['autenticado'] !=true) {
    $_SESSION['tipo'] = "alerta-warning";
    $_SESSION['mensagem'] = "
    <strog>Ops!</strong><br>
    Favor Inserir seus dados de acesso.
    ";

    header("Location: /dgp/sistema/tela-login.php");
    exit;
} else{
    $tempo_atual = time();
    $limite_disponivel = 3000; //limite de tempo em segundos
    $tempo_limite = $_SESSION['inicio_sessao'] + $limite_disponivel;
    
    if($tempo_limite > $tempo_atual){
        //ainda esta no limite de uso
        $_SESSION['inicio_sessao']= time();
    } else{
        //tempo limite foi ultrapassado po inatividade
        $_SESSION['autenticado']=false;
        $_SESSION['tipo']= "alert-warning";
        $_SESSION['mensagem']= "
        <strong>OPS!</strong><br>
        Tempo Expirado. Faça novamente login.
        ";
        header("Location: /dgp/sistema/tela-login.php");
        exit;
    }

   

}
?>