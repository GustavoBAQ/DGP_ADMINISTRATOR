<?php 
    session_start(); //Iniciar sessao   

    // Aqui irá definir o tempo de zona para todo o php 
    date_default_timezone_set('America/Sao_Paulo');
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ponto</title>
</head>
<body>
    <h2>Registrar Ponto</h2>
    <?php 
    // Se houver essa variavel global
    if(isset($_SESSION['msg'])){
        // mostre a 
        echo ($_SESSION['msg']);
        // E a destru, para que mostre apenas uma unica vez
        unset ($_SESSION['msg']);
    }
    ?>

    <p id="horario"><?php echo date("d/m/Y H:i:s"); ?></p>

    <a href="registrar_ponto.php">Registrar</a><br>
    <!-- Para atualizar o horario usaremos Javascript -->
    <script>
        //  Criar uma varivel em java
        var apHorario = document.getElementById("horario")
        // A varivel apHorario ira apresentar no id "horario ou seja ira receber essa varivale"


        function atualizarHorario(){
            // Pegara a dara do local para o javascript
            var data = new Date().toLocaleString("pt-br", {
                
                // Pega a hora e data da zona localizada
                timeZone:"America/Sao_Paulo"
            });
            // fomatarData ira substituir a , por - 
            var fomatarData = data.replace(",", "-");

            // A variavel apHorario irá receber a variavel formatarData
            apHorario.innerHTML = fomatarData;
        }
        // Acada milesegundo sera chamada a função atualizar horario
        setInterval(atualizarHorario,  1000);
    </script>

</body>
</html>