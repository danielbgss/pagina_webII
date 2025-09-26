<?php 
    $link = mysqli_connect("localhost:3306", "root", "");
    $select = mysqli_select_db($link, "loja_digital");
    if (!$select) {
        echo "Não foi possível conectar ao banco de dados";
        die();
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livrai-nos com conhecimento</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" id="navegacao">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" id="titulo">Livrai-nos com conhecimento</a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link active" href="categorias.php">Categorias</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link active" href="arquivos_digitais.php">Livros Disponíveis</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opções de Administrador
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="compra.php">Compras Realizadas</a></li>
                            <li><a class="dropdown-item" href="usuarios.php">Lista de Usuários</a></li>
                            <li><a class="dropdown-item" href="add_livro.php">Adicionar Livro</a></li>
                        </ul>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php 
        $result = mysqli_query($link, "SELECT arq.DESCRICAO as descricao_livro , arq.ID as id_livro, arq.Nome as nome_livro, SUM(cad.QTDE) as total_livro from compra_arquivo_digital cad INNER JOIN compra C ON cad.COMPRA_ID = C.ID INNER JOIN arquivo_digital arq ON cad.ARQUIVO_DIGITAL_ID = arq.ID WHERE c.PGTO_STATUS = 'PAGO' GROUP BY arq.ID, arq.NOME ORDER BY total_livro DESC");
        $recente = mysqli_query($link, "SELECT C.CRIADO_EM as data_compra , arq.DESCRICAO as descricao_livro, arq.Nome as nome_livro, arq.ID as id_livro FROM compra_arquivo_digital cad INNER JOIN compra C ON cad.COMPRA_ID = C.ID INNER JOIN arquivo_digital arq ON cad.ARQUIVO_DIGITAL_ID = arq.ID WHERE C.PGTO_STATUS = 'PAGO' GROUP BY arq.ID, arq.NOME ORDER BY C.CRIADO_EM DESC");
        
    ?>
    
    <div class="container text-center">
        <div class="container text-center">
            <h1 id="center_title">Livros mais Vendidos</h1>
        </div>
    
    
        
        <div class="container">
        <div class="row justify-content-center">
            
           
                
        <?php $lista_comprados = [];?>
        <?php for ($i = 0; $i < 9; $i++): ?>
            <?php $linha = mysqli_fetch_assoc($result); ?>
                <?php 
                    echo "<div class='col-sm-4 d-flex mb-4 text-center'>
                            <div class='card' style='width: 18rem;'>
                                <img src='imagens/".$linha['id_livro'].".jpg' class='card-img-top' atl='Imagem do Livro'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$linha['nome_livro']."</h5>
                                    <p class='card-text'>" .$linha['descricao_livro'] ."</p>
                                    <p class='card-text'> Total de vendas: ".$linha['total_livro']."</p>
                                    

                                </div>
                            </div>
                        </div>";  
                    $lista_comprados[] = $linha['id_livro'];
                ?>
                
            
        <?php endfor ?>
            </div>
        </div>
    </div>
    <div class="container text-center">
        <div class="container text-center">
            <h1 id="center_title">Comprados Recentemente</h1>
        </div>

    <div class="container">
        <div class="row justify-content-center">
            <?php $x = 0; ?>
            <?php while ($x < 3 && $recente_livros = mysqli_fetch_assoc($recente)) : ?>
                    <?php
                        if (!in_array($recente_livros['id_livro'], $lista_comprados)) {
                            echo "<div class='col-sm-4 d-flex mb-4 text-center'>
                                    <div class='card' style='width: 18rem'>
                                        <img src='imagens/".$recente_livros['id_livro'].".jpg' class='card-img-top' alt='Imagem do Livro'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>".$recente_livros['nome_livro']."</h5>
                                        <p class='card-text'>".$recente_livros['descricao_livro']."</p>
                                        <p class= 'card-text'>Horário da Compra: ".$recente_livros['data_compra']."</p>
                                    </div>
                                    </div>
                                </div>";
                            $lista_comprados[] = $recente_livros['id_livro'];
                            $x++;
                        }
                    ?>
            <?php endwhile ?>
        </div>
    </div>
    
</body>
</html>