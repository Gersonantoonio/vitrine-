<?php

if(session_status()===PHP_SESSION_NONE){
    session_start();
}
if(empty($_SESSION['Nome'])){
    header("Location: ../../index.php");
}