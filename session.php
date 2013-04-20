<?php

session_start();
//session control
function open_session() {
     session_start();
     $_SESSION['is_open'] = TRUE;
}

function close_session() {
     session_write_close();
     $_SESSION['is_open'] = FALSE;
}

function destroy_session() {
     session_destroy();
     $_SESSION['is_open'] = FALSE;
}

function session_is_open() {
     return($_SESSION['is_open']);
}

?>