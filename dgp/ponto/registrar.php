<?php 

session_start(); //Iniciar sessao

//limpar o buffer de daida para não apresentar erro de direcionamento
ob_start();


// Definir zona de horario para o php
date_default_timezone_set('America/Sao_Paulo');

// A varivel ira receber o horario atual
// Gerar com PHP o horarario atual
$horario_atual = date("H:i:s");
//var_dump($horario_atual);
// Gerar a data do PHP que deve ser salva no banco de dados
$data_entrada = date('Y/m/d');

// Incluir somente uma vez 
include_once "conexao.php";

// Qual úsuario esta utilizando
$profissao_setor = '1';

// Recuperar o ultimo ponto do usuario

$query_ponto = "SELECT id_temporizador, saida_intervalo, retorno_intervalo, saida
    From temporizadores
    WHERE id_profissao_setor = :id_profissao_setor
    ORDER BY id_profissao_setor DESC
    LIMIT 1";

// Preparar a consulta mandando a para a conexao, se precisar alterar os parametros e por fim a executa-la

// Preparar uma consulta no banco de dados 
$result_ponto = $conn->prepare($query_ponto);


// Substituir o valor dentro da consulta pelo valor
// Dentro da consulta sera substituido o valor id_usario 
$result_ponto->bindParam(':id_profissao_setor', $profissao_setor);

// Executar a consulta 
$result_ponto -> execute();

// Verificar se achou algum registro no banco de dados 
if (($result_ponto) and ($result_ponto -> rowCount() != 0)){
    // Realizar leitura do registro

    // fetch(): Retorna uma unica row da consulta, ideal para poder utilizar em consultas como login, que retorna somente um resultado. 
    //fetchAll(): Retorna um array com todas as linhas da consulta, ideal para uma busca por nome ou por endereço.
    
    //O PDO::FETCH_ASSOC, ou seja, ele retornará um array associativo exemplo:
    //[“nome”=>”Marcio Lucas”, “login” => “doidera123”, “senha” => “pamonha321”];
    $row_ponto = $result_ponto -> fetch(PDO::FETCH_ASSOC);
    //var_dump($row_ponto);
   
    // Extrair para imprimri atraves do nome da chave array
    extract($row_ponto);

    // verificar se o usuario bateu o ponto de intervalo
    if(($saida_intervalo == " " ) or ($saida_intervalo == null)){
        // Significa que o colaborador só bateu o ponto de entrada

        // Qual coluna no banco de dados deve receber o registro
        $col_tipo_registro = "saida_intervalo";

        //Tipo da ação
        $tipo_registro = "editar";

        // Texto para o colaborador
        $text_tipo_registro = "saida para o intervalo";

    }
 // verificar se o usuario bateu o ponto de retorno de intervalo
  elseif(($retorno_intervalo == " " ) or ($retorno_intervalo == null)){
        // Significa que o colaborador só bateu o ponto de entrada

        // Qual coluna no banco de dados deve receber o registro
        $col_tipo_registro = "retorno_intervalo";

        //Tipo da ação
        $tipo_registro = "editar";

        // Texto para o colaborador
        $text_tipo_registro = "retorno do intervalo";

    } // verificar se o usuario bateu o ponto de saida
    elseif(($saida == " " ) or ($saida == null)){
     // Significa que o colaborador só bateu o ponto de entrada

        // Qual coluna no banco de dados deve receber o registro
        $col_tipo_registro = "saida";

     //Tipo da ação
        $tipo_registro = "editar";

        // Texto para o colaborador
        $text_tipo_registro = "saida";

    }// Criar um novo registro no BD com horario de entrada
    else{
    
        //Tipo da ação
        $tipo_registro = "entrada";

        // Texto para o colaborador
        $text_tipo_registro = "entrada";

    }
}


else{
     //Tipo da ação
     $tipo_registro = "entrada";

     // Texto para o colaborador
     $text_tipo_registro = "entrada";
}

// Verificar o tipo de regsitro, novo ponto ou editar registro exitente
switch($tipo_registro){
    // Acessa o case quando deve editar o registro
   case "editar":
    // Query (solicitação) para edirar no banco de dados 
    $query_horario = "UPDATE temporizadores SET $col_tipo_registro =:horario_atual
        WHERE id_profissao_setor = :id_profissao_setor
        LIMIT 1";

        // Preparadno nossa consulta
        $cad_horario = $conn->prepare($query_horario);

        // Substituit parametros(no caso um link) na query 
        $cad_horario->bindParam(':horario_atual', $horario_atual );
        $cad_horario->bindParam(':id_profissao_setor', $id_profissao_setor );

    break;
    default:
        //Query para cadastrar no banco de dados
        $query_horario = "INSERT INTO temporizadores (data_entrada, entrada, id_profissao_setor) VALUES (:data_entrada, :entrada, 
        :id_profissao_setor) ";

        //Prepara a query
        $cad_horario = $conn->prepare($query_horario);

        // Substituir o link(parametro)
        $cad_horario->bindParam(':data_entrada', $data_entrada );
        $cad_horario->bindParam(':entrada', $horario_atual );
        $cad_horario->bindParam(':id_profissao_setor', $id_profissao_setor);


    break;
}

// Executar a query
$cad_horario->execute();



// Se cadastrar com sucesso 
if ($cad_horario->rowCount()){
    $_SESSION['msg'] = "<p>horario de $text_tipo_registro cadastrado com sucesso!</p>";
    header("Location: index.php");
} else{
    $_SESSION['msg'] = "<p>horario de $text_tipo_registro não cadastrado com sucesso!</p>";
    header("Location: index.php");
}

?>