<?php
if(isset($_SESSION['tipo']) && isset($_SESSION['mensagem']) && isset($_SESSION['button_encerrar'])){
// SE EXISTIR AS VARIÁVES DE SESSÃO
 
 echo'
 <div class="alert '. $_SESSION['tipo'] . ' alert-dismissible fade show" role="alert">
 '.$_SESSION['mensagem'] . '
 <button type="button" class="btn-close button--alert" data-bs-dismiss="alert" aria-label="Close"> '. $_SESSION['button_encerrar'] .' </button>
 </div>
 ';

unset($_SESSION['tipo']);
unset($_SESSION['mensagem']);
unset($_SESSION['button_encerrar']);
}
?>
