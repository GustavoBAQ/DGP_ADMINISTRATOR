<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exeception;


require 'PHPMailer-6.7.1/src/Exception.php';
require 'PHPMailer-6.7.1/src/PHPMailer.php';
require 'PHPMailer-6.7.1/src/SMTP.php';
session_start();


include("conexao.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/dashboard.css" rel="stylesheet">
    <title>Document</title>
    <style>
       
        body{
            background-image: url(img/blob-scene-haikei.svg);
            background-size: cover;
        }

      .login-content{
        display: flex;
        justify-content: center;
      }
        .form {
        display: flex;
        flex-direction: column;
        gap: 10px;
        background: #1e1e1e;
        padding: 20px;
        border: 1px solid #3d3c3c;
        border-radius: 10px;
        color: white;
        text-align: center;
        font-size: 20px;
        width: auto;
    }

    img{
        height: 15vh !important;
        padding-bottom: 10%;
    }
    .form input {
        height: 35px;
        outline: none;
        border: 2px solid #66CDAA;
        background: transparent;
        padding: 20px 10px;
        border-radius: 5px 0px 0px 5px;
        transition: .5s;
        color: white;
        font-size: 20px;
    }

    .input--email {
        border-radius: 5px !important;
        /* padding-right: 12% !important;
        margin-left: 8% !important; */
       
    }

    .form input:focus {
        background: #66CDAA;
    }

    .form button {
        width: 70%;
        color: white;
        transition: .5s;
        font-size: 20px;
        outline: none;
        border: none;
        height: 45px;
        border-radius: 5px;
        background: #66CDAA;
        align-self: center;
    }

    .icon--input {
        position: absolute;
        padding-right: 80px;
        padding-top: 5px;


    }

    .button--alert {
    width: 5% !important;
    height: 5% !important;
    display: flex;
    align-items: center;
}

    .inputIconBg {
        background-color: #66CDAA;
        color: #fff;
        padding: 9px 4px;
        border-radius: 0px 4px 4px 0px;
        height: 44px;
    }
    .container-fluid{
        height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .title--prin{
    color: #3d3c3c;
    padding-bottom: 10%;
  }

  .alert.alert-success.alert-dismissible.fade.show.alert {
    width: 50%;
}


    </style>
</head>
<body>
<!-- <form method="post">
    <div  class="container d-flex justify-content-center  align-items-center ">
        <label for="email">E-mail:</label>
        <input type="text" name="email" id="email" />
        <input type="submit"  value="Recuperar" />
    </div>
</form> -->

<div class="container-fluid">
        
        
        <div class="login-content">

            <form method="post" class="form mb-3">

                <img src="img/avatar.svg">
                <h2 class="title--prin">Esqueceu a Senha?</h2>
                <!-- <h2 class="title">Digite</h2> -->


                Digite seu E-mail
                <div class="username ">
                    <input require type="email" class="form-control input--email" id="email"  name="email" placeholder="name@exemple.com">
                </div>
                <div>
                    

                <!-- <input type="submit" class="btn button--input" value="Recuperar" > -->
                <button  type="submit" value="recuperar" style="margin-top: 2%;" class="mb-3">Recuperar</button>

              
            </form>
        </div>
    </div>



    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['email'])) {

    $user = trim($_POST['email']);
} else {
    $user = "";
}
$sql = mysqli_query($conecta, "SELECT * FROM usuarios WHERE email = '$user' ");

//Confirmando se o email inserido existe dentro do banco de dados 
if (mysqli_num_rows($sql) == 1) {
    //Caso o numero de registros seja igual a 1, significa que existe algum registro com esse email

    //criar chave aleatoria para proteção da URL
    $chave = sha1(uniqid(mt_rand(), true));

    //Guardamos o registro do usuario que fez a requisição e a chave aleatoria (logo mais sera deletado)
    $conf = mysqli_query($conecta, "INSERT INTO recuperacao VALUES('$user', '$chave')");

    if (mysqli_affected_rows($conecta) == 1) {

        $link = "http://localhost/dgp/sistema/tradepassword.php?utilizador=$user&confirmacao=$chave";

        $mensagem = "<p>Seu link para recuperação de senha: $link.</p>";

        $mail = new PHPMailer(true);

        // Diz ao PHPMailer para usar SMTP
       $mail->isSMTP();
        //Ativa a depuração SMTP
       //SMTP::DEBUG_OFF = off (para uso em produção)
       //SMTP::DEBUG_CLIENT = mensagens do cliente
       //SMTP::DEBUG_SERVER = mensagens de cliente e servidor
       $mail->SMTPDebug = SMTP::DEBUG_OFF   ;
       $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
       
       //Define o hostname do servidor de email
       $mail->Host = 'mail.g1a.com.br';
        //Defina o número da porta SMTP - provavelmente 25, 465 ou 587
       $mail->Port = 465;
        //Se deve usar a autenticação SMTP
       $mail->SMTPAuth = true;
       
        //Nome de usuário a ser usado para autenticação SMTP
       $mail->Username = 'senac@g1a.com.br';
       
        //Senha a ser usada para autenticação SMTP
       $mail->Password = 'Senac@2023';
       
        //Definir de quem a mensagem será enviada
       $mail->setFrom('senac@g1a.com.br', 'Sistema DGP Administrator');
       
        //Defina um endereço de resposta alternativo
       $mail->addReplyTo('dgpAdministrator@gmail.com', 'Sistema DGP Administrator');
       
        //Definir para quem a mensagem será enviada
       $mail->addAddress($user);
    //    $mail->addAddress('senac@g1a.com.br');
        //ENVIO EMAIL EM CÓPIA
       //$mail->abbCC(exemplo@exemplo.com, 'Nome exemplo');
        //ENVIAR EMAIL EM CÓPIA OCULTA
       //$mail->abbBCC(exemplo@exemplo.com, 'Nome exemplo);
        //Define a linha de assunto
       $mail->Subject = 'Recuperando acesso';
       
       //Lê um corpo de mensagem HTML de um arquivo externo, converte imagens referenciadas em incorporadas,
       //converte HTML em um corpo alternativo básico de texto sem formatação
       $mail->CharSet = 'UTF-8';
       $mail->msgHTML($mensagem);

       
        // Exibe uma mensagem de resultado 
        
    }



    if (!$mail->send()) {
        $_SESSION['tipo'] = "alert-danger";
        $_SESSION['mensagem'] = "<strong>Ops! 😕</strong><br>Falha ao tentar Enviar o email.";
        $_SESSION['button_encerrar'] = "";
        include('alert.php');
        
    } else {
    
        $_SESSION['tipo'] = "alert-success";
        $_SESSION['mensagem'] = "<strong>Oba!</strong><br>Seu novo acesso foi enviado por e-mail.";
        $_SESSION['button_encerrar'] = "X";
        

        header("location: tela-login.php");

     exit();
    }

        
}


?>