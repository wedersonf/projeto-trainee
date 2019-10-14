<?php

require ("./classes/ProdutoCRUD.php");

$crud = new ProdutoCRUD ("localhost", "eletronicos", "root", "");

var_dump($_POST);

$tipo = $_POST['tipo'];
$valor = $_POST['valor'];
$descricao = $_POST['descricao'];

$imagem_addr = "../images/".$_FILES['imagem']['name'];

if (move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem_addr)) {

    $retorno = $crud -> create ($tipo, $valor, $descricao, $imagem_addr);

    if ($retorno) {
        echo "<p>CRIADO</p>";
    }
    else {
        echo "<p>NÃO CRIADO</p>";
    }

}
else {

    echo "<p>IMAGEM NÃO MOVIDA</p>";

}

header("Location: ./read.php");

?>
