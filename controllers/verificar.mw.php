<?php
//middleware de verificación

    function mw_estaLogueado(){
        if( isset($_COOKIE["user_logged"]) && $_COOKIE["user_logged"] == true){
          return true;
        }else{
          $_COOKIE["user_logged"] = false;
          $_COOKIE["user_logged"] = "";
            session_destroy();
            session_unset();
          return false;
        }
    }
    function mw_setEstaLogueado($usuario, $logueado){
        if($logueado){
           //
        }else{
            session_destroy();
            session_unset();
            unset($_COOKIE['user_logged']); 
            setcookie('user_logged', null, 1); 
           
            return true;
        }
    }
    function mw_redirectToLogin($to){
        $loginstring = urlencode("?".$to);
        $url = "index.php?page=login&returnUrl=".$loginstring;
        header("Location:" . $url);
        die();
    }

?>
