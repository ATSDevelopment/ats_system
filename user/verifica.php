<?php

// Inicia sessões

//session_start();

	


	if((!isset ($_SESSION['id_usuario'])) and (!isset ($_SESSION['nome_usuario'])))
	{
		header('location:login.php');
		exit;
	}




?>