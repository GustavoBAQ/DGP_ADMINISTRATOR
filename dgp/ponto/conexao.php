<!-- Irá fazer a conexao com o banco de dados -->

<?php
// Iniciando conexao com banco de dados
// Conexão Utilizando PDO
// O PDO (PHP Data Object) é uma extensão da linguagem PHP para acesso a banco de dados

$host= "localhost";
$user = "root";
$pass = "";
$dbname = "dgp";
// $port = 3306;

try{
    $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);

} catch(PDOException $err){
    echo "Erro: conexão com banco de dados não realizada com sucesso. Erro gerado " . $err->getMessage();
    // Recuperando erro com o PDOExeception
}



?>