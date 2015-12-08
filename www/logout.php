<?php

// Inicia sessões, para assim poder destruí-las

session_start();

session_unset();

session_destroy();



header("Location: index.php");

?>