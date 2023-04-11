<?php
// INICIAR SESSÃO PARA TRABALHAR COM VARIÁVEIS GLOBAIS "SESSION_START()"
session_start();
include('conexao.php');
$email = trim($_POST["email"]);
$senha = sha1(trim($_POST["senha"]));

$sql = "SELECT  * FROM usuarios
WHERE email = '$email'
and senha= '$senha'
";
$query = mysqli_query($conecta,$sql);

if (mysqli_num_rows($query) > 0) {
    // REDIRECIONAR PARA TELA INICIAL DO SISTEMA
    $_SESSION['autenticado'] = true;
    $_SESSION['inicio_sessao'] = time();
    $_SESSION['EmailUsuario'] = $email;
   
    header('location: index.php');
}
else {
    // NÃO ENCONTROU O USUARIO NO BANCOS DE DADOS
    $_SESSION['tipo'] = 'alert-danger';
    $_SESSION['mensagem'] = "<strong>Ops!</strong> <br> E-mail e/ou senha invalido.";
    $_SESSION['button_encerrar'] = "X";
    
    
    
    

    header('location: tela-login.php');
}
$resultado = mysqli_fetch_assoc($query);

// Se a sessão não existir, inicia uma
if (!isset($_SESSION)) session_start();
// Salva os dados encontrados na sessão
$_SESSION['UsuarioID'] = $resultado['id_usuario'];





// $query = "select * from usuarios where login='{$email}' and senha = '{$senha}'";

// $result = mysqli_query($conecta, $query);

// $row = mysqli_num_rows($result);



// if ($row > 0) {

//     $dados_usuario = mysqli_fetch_assoc($result);

//     $_SESSION['id_usuario'] = $dados_usuario['id_usuario'];
//     $_SESSION['email'] = $email;
//     $_SESSION['senha'] = $senha;

// }
?>