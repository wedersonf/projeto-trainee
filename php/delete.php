<?php

require ("./classes/ProdutoCRUD.php");

$crud = new ProdutoCRUD ("localhost", "eletronicos", "root", "");

$id_deleta = $_POST["id"];

$retorno = $crud -> delete ($id_deleta);

header("Location: ./read.php");

?>
