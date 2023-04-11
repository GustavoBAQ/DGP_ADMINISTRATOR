<?php

$caminho = "localhost";
$usuario = "root";
$senha = "";
$banco_dados = "dgp";
$conecta = mysqli_connect($caminho,$usuario,$senha,$banco_dados);
if($conecta){
    mysqli_query($conecta,"SET lc_time_names = 'pt_BR'"); // fica em portugues
    mysqli_set_charset($conecta,"utf8"); //coloca "utf8" acentuacao no texto
    // echo"conectado com sucesso!";
}
else{
    echo"Falha ao tentar se conectar!";
}

?>