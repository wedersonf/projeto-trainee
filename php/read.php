<html>

<head>
    <title>Painel de Controle</title>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="../css/control-panel.css" >
    
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/frontend_1.css">
    <link rel="stylesheet" href="../css/frontend_2.css">
</head>

<body>
    
    <!-- HEADER -->
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../images/frontend/ID_Visual_WED.png" alt="Wed">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
                aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">INÍCIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">PAINEL</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">CONTATO</a>
                    </li> -->
                </ul>
                <!-- <form class="form-inline my-2 my-md-0">
                    <input class="form-control" type="text" placeholder="">
                    <button type="submit" class="btn btn-light">BUSCAR</button>
                </form> -->
            </div>
        </div>
    </nav>

    <!-- TABELA CRUD -->
    <?php
    
    require ("./classes/ProdutoCRUD.php");  // CRUD dos produtos
    require ("./classes/Cropper.php");      // Thumbnail das imagens

    $thumb = new \CoffeeCode\Cropper\Cropper ("../images/cache/"); // Diferentão assim pq tá em um namespace diferente

    $crud = new ProdutoCRUD ("localhost", "eletronicos", "root", "");
    $retorno = $crud -> read ();

    echo '<div id="content"><table>
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

    echo "</table></div>";

    ?>

    <!--FOOTER-->
    <hr id="hr">
    <footer id="footer">
        <img src="../images/frontend/ID_Visual_WED.png" id="logo">
        <h4 id="desenvol">Desenvolvido por Equipe Wederson</h4>
        <a href="http://instagram.com/"><img src="../images/frontend/insta.png" id="insta"></a>
        <a href="http://facebook.com/"><img src="../images/frontend/face.png" id="face"></a>
        <a href="http://twitter.com/"><img src="../images/frontend/twitter.png" id="twitter"></a>
    </footer>


    <!-- BOOTSTRAP SCRIPTS -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="../javascript/bootstrap/bootstrap.min.js"></script>

    <!-- SCRIPT -->
    <script src="../javascript/control-panel-btns.js"></script>

</body>

</html>

