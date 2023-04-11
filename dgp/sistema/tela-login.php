<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">




</body>
<!--  -->

<head>
    <title>Animated Login Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<style>
    body {
        background-image: url(img/blob-scene-haikei.svg);
        background-size: cover;

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

    input {
        padding: 1px 1.84em !important;
    }

    .inputIconBg {
        padding-bottom: 1%;
        color: #fff;
      
        border-radius: 0px 4px 4px 0px;
        height: 44px;
    }

    .login-content {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        text-align: center;




    }

    .input--password{
        border-right: 0px !important;
    }

    .button--alert{
        width: 5% !important;
        height: 5% !important;
        display:flex;
        align-items: center;
    }
</style>

<body>

    <div class="container">
        <div class="img">

        </div>
        <div class="login-content">

            <form method="post" action="valida-login.php" class="form">

                <img src="img/avatar.svg">
                <h2 class="title">Bem Vindo</h2>


                Login
                <div class="username ">
                    <input require type="email" class="form-control input--email" id="username" name="email" placeholder="name@exemple.com">
                </div>
                <div>
                    <div>






                        <div class=" d-flex justify-content-between">
                            <input require type="password" class="form-control input--password " id="Password" name="senha" placeholder="senha">
                            <span class="position-relative div--icon2 end-0 pt-1">
                                <i id="icon--password"  class="bi div--icon view2  div--icon2 bi-eye-fill pe-1 inputIconBg " aria-hidden="true"></i>

                            </span>
                        </div>






                    </div>
                    <div>
                        <a style="text-align: center;" href="esquecipassword.php">Esqueci a senha </a>
                    </div>


                    <button style="margin-top: 2%;"  class="mb-3">Entrar</button>
                    <?php include("alert.php")?>
            </form>
        </div>
    </div>



    <script>
        const input = document.querySelector('#Password')
        const icon = document.querySelector('#icon--password')


        icon.addEventListener('click', verificar)

        function verificar() {
            for (let i = 0; i < icon.classList.length; i++) {
                if (icon.classList[i].toString() == "bi-eye-fill") {
                    input.type = "text"
                    icon.classList.remove('bi-eye-fill')
                    icon.classList.add("bi-eye-slash")

                    exit()

                } else if (icon.classList[i].toString() === "bi-eye-slash") {
                    input.type = "password"
                    icon.classList.remove("bi-eye-slash")
                    icon.classList.add('bi-eye-fill')
                    exit()
                }
            }

        }
    </script>
    <!-- choose one -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>