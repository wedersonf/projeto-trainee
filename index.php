<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>We:D Produtos Eletrônicos</title>

    <!--BOOTSTRAP CSS ANDRESSA-->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/frontend_1.css">

    <!--BOOTSTRAP CSS MATHEUS-->
    <link rel="stylesheet" href="css/frontend_2.css">

</head>

<body>
    <!--HEADER-->
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/frontend/ID_Visual_WED.png" alt="Wed">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
                aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">INÍCIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./php/read.php">PAINEL</a>
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

    <!--CAROUSEL-->
    <div id="wed-carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#wed-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#wed-carousel" data-slide-to="1"></li>
            <li data-target="#wed-carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/frontend/1.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/frontend/2.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/frontend/3.png" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#wed-carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#wed-carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!--CONTENT-->
    <div id="geral">
      
        <h1 id="title1">Produtos Populares</h1>

        <?php
        
        require ("./php/classes/ProdutoCRUD.php");
        require ("./php/classes/Cropper.php");

        $crud = new ProdutoCRUD("localhost", "eletronicos", "root", "");
        $produtos = $crud -> read();

        $thumb = new \CoffeeCode\Cropper\Cropper ("./images/cache/");

        $counter = 0;
        foreach ($produtos as $produto) {
            $id = $produto[0]; // id
            $tipo = $produto[1]; // tipo
            $valor = $produto[2]; // valor
            $descricao = $produto[3]; // descricao
            $imagem = $produto[4]; // endereço da imagem

            $img_link = "./php/".$produto[4]; // arruma endereço da imagem
            $img_thumb = $thumb -> make ($img_link, 300, 300); // cria um thumbnail

            if ($counter % 4 == 0) {
                echo '<div class="card-deck" id="card_group_1">'; //inicia uma nova linha
            }

            //cria o card
            echo '<div class="card">
            <a href="'. $img_link .'" target="_blank" id="link">
                <img src="'. $img_thumb .'" class="card-img-top" alt="foto do produto">
            </a>
            <div class="card-body">
                <h5 class="card-title">'. $descricao .'</h5>
                <p class="card-text">'. $tipo .'</p>
                <h3 id="price">R$ '. number_format((float)$valor, 2, '.', ',') .'</h3>
                <button type="button" name="" value="" class="css3button">Adicionar ao carrinho</button>
            </div>
        </div>';

            if ($counter % 4 == 3) {
                echo "</div>"; //termina a linha
            }

            $counter ++;
        }

        if ($counter % 4 != 0) {
            echo "</div>"; // termina a linha
        }
        
        ?>

        <!--QUEM SOMOS-->
        <hr>

        <div class="aside accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne" id="quems">
                            ➤ Quem Somos?
                        </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <h5 align="justify" id="quemtxt">
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbspAnim pariatur cliche
                            reprehenderit,enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon
                            officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                            eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                            nulla assumenda shoreditchet. Nihil anim keffiyeh helvetica, craft beer labore wes anderson
                            cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                            craft beer farm-to-table, rawdenim aesthetic synth nesciunt you probably haven't heard of
                            them accusamus labore sustainable VHS.
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <!--CONTATO-->
    <h1 id="title1">Fale conosco</h1>
    <form class="aside form-group" id="contato" method="POST" action="./php/contato.php">
        <input class="form-control" type="text" name="nome" placeholder="Nome">
        <br>
        <input class="form-control" type="email" name="email" placeholder="E-mail">
        <br>
        <textarea class="form-control" name="message" placeholder="Mensagem"></textarea>
        <br>
        <button type="submit" value="" class="css3button">Enviar</button>
    </form>

    <!--FOOTER-->
    <hr id="hr">
    <footer id="footer">
        <img src="images/frontend/ID_Visual_WED.png" id="logo">
        <h4 id="desenvol">Desenvolvido por Equipe Wederson</h4>
        <a href="http://instagram.com/"><img src="images/frontend/insta.png" id="insta"></a>
        <a href="http://facebook.com/"><img src="images/frontend/face.png" id="face"></a>
        <a href="http://twitter.com/"><img src="images/frontend/twitter.png" id="twitter"></a>
    </footer>

    <!--BOOTSTRAP SCRIPTS-->
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="javascript/bootstrap/bootstrap.min.js"></script>

</body>

</html>