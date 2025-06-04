<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "db_projeto_senac";

$conexao = mysqli_connect($servidor, $usuario,$senha,$dbname);

if(!$conexao){
   die("falha na conexão do banco de dados:" . mysqli_connect_error());
}
 
?>