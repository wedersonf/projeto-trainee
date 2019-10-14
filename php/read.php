<html>

<head>
    <title>Painel de Controle</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/control-panel.css" >
</head>

<body>
    
    <!-- HEADER -->

    <?php
    
    require ("./classes/ProdutoCRUD.php");  // CRUD dos produtos
    require ("./classes/Cropper.php");      // Thumbnail das imagens

    $thumb = new \CoffeeCode\Cropper\Cropper ("../images/cache/"); // Diferentão assim pq tá em um namespace diferente

    $crud = new ProdutoCRUD ("localhost", "eletronicos", "root", "");
    $retorno = $crud -> read ();

    echo '<table>
        <tr> <th class="colId">ID</th> <th class="colType">TIPO</th> <th class="colValue">VALOR</th> <th class="colDescription">DESCRIÇÃO</th> <th class="colImg">IMAGEM</th> <th colspan=2></th> </tr>';

    echo '<tr title="Cadastre um novo produto" id="cadastro"><form enctype="multipart/form-data" action="./create.php" method="POST">
        <td class="colId">#</td><td class="colType"><input placeholder="tipo do produto" name="tipo" type="text"></td><td class="colValue"><input placeholder="9.99" name="valor" type="text"></td><td class="colDescription"><input placeholder="descrição do produto" name="descricao" type="text"></td><td class="colImg"><input name="imagem" type="file">
        <td class="colButtons" colspan=2><button type="submit">Cadastrar Produto</button></td></form></tr>';

    $counter = 0;
    foreach ($retorno as $produto) {
        
        $img_link = "../images/".$produto[4];

        $img_thumb = $thumb -> make ($img_link, 40, 40);
        
        echo '<tr title="Altere o produto já cadastrado">
            <td class="colId"><p class="data'.$counter.'">' . $produto[0] . '</p><input name="id" value="' . $produto[0] . '" type="hidden"></td>
            <td class="colType"><input class="data'.$counter.'" name="tipo" value="' . $produto[1] . '" type="text"></td>
            <td class="colValue"><input class="data'.$counter.'" name="valor" value="' . number_format((float)$produto[2], 2, '.', '') . '" type="text"></td>
            <td class="colDescription"><input class="data'.$counter.'" name="descricao" value="' . $produto[3] . '" type="text"></td>
            <td class="colImg"><a href="' . $img_link . '" target="_blank"><img title="' . $produto[4] . '" src="' . $img_thumb . '"></a><input class="data'.$counter.'" name="imagem" value="' . $produto[4] . '" type="text"></td>';

        echo "<td title='Confirme as alterações feitas no produto' class='colButtons' ><button href='./update.php' onClick='updateBtn($counter)'>Alterar</button></td>";
        
        echo "<td title='Delete o produto' class='colButtons' ><button onClick='deleteBtn($counter)'>Deletar</button></td>";

        echo '</tr>';

        $counter ++;
    }

    // echo '<tr><td colspan=7><hr></td></tr>';

    echo "</table>";

    ?>

    <!-- FOOTER -->

    <script src="../javascript/control-panel-btns.js"></script>

</body>

</html>

