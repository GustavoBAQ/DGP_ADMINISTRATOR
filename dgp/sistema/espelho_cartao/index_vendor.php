<?php
// Incluir conexao com BD
include('../conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Celke - Gerar PDF com imagem</title>
</head>

<body>

    <h1>Como gerar PDF com PHP</h1>

    <?php
    // Receber os dados do formulário
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    var_dump($dados);

    // Acessa o IF quando existe a data inicial e data final
    if ((isset($dados['data_inicio'])) and (isset($dados['data_final']))) {
        echo "<a href='gerar_pdf.php?data_inicio=" . $dados['data_inicio'] . "&data_final=" . $dados['data_final'] . "'>Gerar PDF da Pesquisa</a><br><br>";
    } else { // Acessa o ELSE quando não há pesquisa entre datas
        echo "<a href='gerar_pdf.php'>Gerar PDF de todos os registros</a><br><br>";
    }
    ?>

    <!-- Formulário pesquisar entre datas -->
    <form method="POST" action="">
        <?php
        // Manter os dados no campo
        $data_inicio = "";
        if (isset($dados['data_inicio'])) {
            $data_inicio = $dados['data_inicio'];
        }
        ?>
        <label>Data de Inicio</label>
        <input type="date" name="data_inicio" value="<?php echo $data_inicio; ?>">
        <br><br>

        <?php
        // Manter os dados no campo
        $data_final = "";
        if (isset($dados['data_final'])) {
            $data_final = $dados['data_final'];
        }
        ?>
        <label>Data de Final</label>
        <input type="date" name="data_final" value="<?php echo $data_final; ?>">
        <br><br>

        <input type="submit" value="Pesquisar" name="PesqUsuario"><br><br>

    </form>

    <?php
    $PesqUsuario = filter_input(INPUT_POST, 'PesqUsuario' , FILTER_SANITIZE_STRING);


    // Acessa o IF quando o usuário clicar no botão pesquisar
    if ($PesqUsuario) {

        // QUERY sql para pesquisar entre datas
        $data_inicial = filter_input (INPUT_POST,  'data_incio', FILTER_SANITIZE_STRING);
        $data_final = filter_input (INPUT_POST,  'data_final', FILTER_SANITIZE_STRING);

        $query_usuarios = "SELECT id_profissao_setor,data_entrada, entrada, saida_intervalo, retorno_intervalo, saida
        FROM temporizadores
        WHERE data_entrada BETWEEN $data_inicio AND $data_final
        ORDER BY data_entrada DESC;";

        // Prepara a QUERY
        // $result_usuarios = $conecta->prepare($query_usuarios);
        // $result_usuarios = $conecta->prepare($query_usuarios);

        // Substitui os link da QUERY pelo valor
        // $result_usuarios->bindParam(':data_inicio', $dados['data_inicio']);
        // $result_usuarios->bindParam(':data_final', $dados['data_final']);
        // $result_usuarios->bind_param("sss", $data_inicio, $data_final);

        // $data_inicial = $dados['data_inicio'];
        // $data_final = $dados['data_final'];

    
        // Executar a QUERY
        $query = mysqli_query($conecta,$query_usuarios);

        // Acessa o IF quando encontrar registro no banco de dados
         if (($query_usuarios) and ($data_inicio > 0)) {

            // Ler os registros retornado do banco de dados
            While($result = mysqli_fetch_array($query)){
                

                echo"
                <tr>
                    <td>$result[data_entrada]</td>
                    <td>$result[entrada]</td>
                    <td>$result[saida_intervalo]</td>
                    <td>$result[retorno_intervalo]</td>
                    <td>$result[saida]</td>
  
                    
                  </tr>
                ";

    
              
    
    // While($result = mysqli_fetch_array($querry)){
              //   echo"
              //   <tr>
              //       <td>$result[id_matricula]</td>
              //       <td>$result[data_matricula]</td>
              //       <td>$result[nome_aluno]</td>
              //       <td>$result[nome_curso]</td>
              //       <td>$result[periodo]</td>
              //     </tr>
              //   ";
            }
  
        } else { // Acessa o ELSE quando não encontrar nenhum registro no banco de dados e imprime a mensagem de erro
            echo "<p style='color: #f00'>Erro: Nenhum usuário encontrado!</p>";
        }
    }

    



    ?>

</body>

</html>