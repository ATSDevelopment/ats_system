<?php
define("ROOT", "..");

//Carregando as bibliotecas
require ROOT."/libs/lib_list.php";

$api = array();
//Definindo as funções
require ROOT."/libs/FuncionarioDAO/api_functions.php";
require ROOT."/libs/ProjetoDAO/api_functions.php";

//Executando a API
$api[$_GET['f']]();
?>