<?php
require "session.php";
session_start();
destroy_session();
session_destroy();

header("Location: http://plato.cs.virginia.edu/~zya6yu/index.php", TRUE, 303);
?>