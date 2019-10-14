<?php

require ("./classes/ProdutoCRUD.php");

$crud = new ProdutoCRUD ("localhost", "eletronicos", "root", "");

$id = $_POST['id'];
$tipo = $_POST['tipo'];
$valor = $_POST['valor'];
$descricao = $_POST['descricao'];
$imagem = $_POST['imagem'];

$retorno = $crud -> update ($id, $tipo, $valor, $descricao, $imagem);

header("Location: ./read.php");

?>
