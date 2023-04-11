<?php
include('conexao.php');

if (empty($_GET['utilizador']) || empty($_GET['confirmacao'])) {
  die('<p>Não é possível alterar a password: dados em falta</p>');
}



$user = trim($_GET['utilizador']);
$hash = trim($_GET['confirmacao']);

$q = mysqli_query($conecta, "SELECT * FROM recuperacao WHERE utilizador = '$user' AND confirmacao = '$hash'");

if (mysqli_num_rows($q) > 0) {

  $html = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
      <link href="css/dashboard.css" rel="stylesheet">
      <title>Document</title>

      <style>
      
      body{
        background-image: url(img/blob-scene-haikei.svg);
        background-size: cover;
      }

      img, svg {
        vertical-align: middle;
        width: 40%;
      }

      .content--login {
        display: flex;
        flex-direction: column;
        align-content: center;
        justify-content: center;
        align-items: center;
      }

      .container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
        --bs-gutter-x: 1.5rem !important;
        --bs-gutter-y: 0  !important;
        width: auto  !important;
        padding-right: calc(var(--bs-gutter-x) * .5)  !important;
        padding-left: calc(var(--bs-gutter-x) * .5)  !important;
        margin-right: auto  !important;
        margin-left: auto  !important;
        height: auto  !important; 
        display: flex  !important;
        flex-direction: column  !important;
        align-content: center  !important;
        align-items: center  !important;
        justify-content: center  !important;
        height: 100vh  !important;
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
          justify-content: center;
          align-items: center;
          width: 50%;
      }
  
      .form input {
          height: 35px;
          outline: none;
          border: 2px solid #66CDAA;
          border-right: 0;
          background: transparent;
          padding: 20px 10px;
          
          transition: .5s;
          color: white;
          font-size: 20px;
      }
  
      .input--email {
        
          /* padding-right: 12% !important;
          margin-left: 8% !important; */
         
      }
  
      .form input:focus {
          background: #66CDAA;
      }
  
      .form button {
          width: 100%;
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
  
      .inputIconBg {
         
          color: #fff;
          rigth: 40px
          
          height: 44px;
      }

      .div--icon {
        
          outline: none;
          border: 2px solid #66CDAA;
          border-left: 0;
          background: transparent;
          padding: 3px 0px 1px 0px;
          border-radius: 0px 5px 5px 0px;
          transition: .5s;
          color: white;
          font-size: 20px;
          top: 56vh;
      }
      
      input{
        padding: 0px 1.84em !important;
    }

    .div--icon2{
      margin-top: 2%;
    }

    .input--trpassword{
      border-radius: 5px 0px 0px 5px !important;
    }

  </style>
  



    </head>
    <body>
   


    <div class="container-fluid">
        
        
        <div class="login-content content--login">

            <form class="form mb-3">

                <img src="img/avatar.svg">
                <h2 class="title--prin">Alterar a senha</h2>
                <!-- <h2 class="title">Digite</h2> -->


                Digite sua nova Senha
                <div class="username ">
                <div class=" d-flex justify-content-between">
                    <input require type="password" class="form-control input--trpassword" id="senha"  name="senha" placeholder="nova senha">
                    <span class="position-relative end-0 pt-1">
                    <i id="icon--password" value="view1" class="bi div--icon view1 bi-eye-fill pe-1 inputIconBg " aria-hidden="true"></i>
                    
                    </span>
                </div>

                <div class=" d-flex justify-content-between">
                <input style="margin-top: 2%;" require type="password" class="form-control input--trpassword" id="confirmaSenha"  name="confirmaSenha" placeholder="Confirme sua senha senha">
                    <span class="position-relative div--icon2 end-0 pt-1">
                    <i id="icon--password2" value="view2" class="bi div--icon view2  div--icon2 bi-eye-fill pe-1 inputIconBg " aria-hidden="true"></i>
                    
                    </span>
                </div>
                    
                    <input type="hidden" name="utilizador" value="' . $user . '">
                   <input type="hidden" name="confirmacao" value="' . $hash . '">
            
            </div>
            <div>
            
            
           
            <button  type="submit"  style="margin-top: 2%; ">Recuperar</button>
            

                   
            </form>

          
        </div>
    </div>




      




    
        
        
      

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js_view.js"></script>

        
    </body>
    </html>
      
    
            ';
  echo $html;
  if (isset($_GET['senha']) & isset($_GET['confirmaSenha'])) {
    $password = $_GET['senha'];
    $Confpassword = $_GET['confirmaSenha'];
  } else {
    $_GET['senha'] = 0;
    $_GET['confirmaSenha'] = 0;
    $Confpassword = 1;
    $password = 0;
  }




  if ($password == $Confpassword) {

    $password;
    $sql = "
                UPDATE usuarios SET senha  = SHA1('$password') WHERE email = '$user';
                DELETE FROM recuperacao WHERE utilizador = '$user' AND confirmacao = '$hash'
                ";
    // os dados estão corretos: eliminar o pedido e permitir alterar a password
    mysqli_multi_query($conecta, $sql);

    
    $_SESSION['tipo'] = "alert-success";
        $_SESSION['mensagem'] = "<strong>SUCESSO!</strong><br>Sua senha foi alterada com sucesso";
        $_SESSION['button_encerrar'] = "";
        include('alert.php');

        sleep(3);
        echo "<script>window.close();</script>";

    
    exit;
  } else if ($Confpassword != 1 && $password != $Confpassword) {
    $_SESSION['tipo'] = "alert-danger";
        $_SESSION['mensagem'] = "<strong>Ops! 😕</strong><br>As senhas não coicidem";
        $_SESSION['button_encerrar'] = "";
        include('alert.php'); 
  }
} else {
  echo '<p>Acesso Negado: Link Expirou</p>';
}



