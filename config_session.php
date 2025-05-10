<?php

    if(!isset($_SESSION['last_regeneration'])){
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
    else{
        $interval = 60 * 30;

        if(time() - $_SESSION['last_regeneration'] >= $interval){

            session_regenerate_id(true);
            $_SESSION['last_regeneration'] = time();
        }
    }

?>