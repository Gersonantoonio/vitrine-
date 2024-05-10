<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



function flashMsg($id, $msg = null)
{
    if (is_null($msg)) {
        echo temFlashMsg($id) ? "<div class='alert alert-$id' role='alert'>{$_SESSION['flashMsg'][$id]}</div>" : "";
        unset($_SESSION['flashMsg'][$id]);
    } else {
        $_SESSION['flashMsg'][$id] = $msg;
    }
}

function temFlashMsg($id)
{
    return isset($_SESSION['flashMsg'][$id]) ? true : false;
}