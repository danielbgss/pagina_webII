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
    <title>Compras</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar bg-secondary">
        <div class="container-fluid">
            <div class="container-fluid text-center">
            <div class="row">
            <div class="col-md-2">
                <a href="index.php" class="btn btn-dark mt-3">Voltar</a>
            </div>
            <div class="col-md-8">
                <div class="container-md">
                    <h1>Lista de Compras Realizadas</h1>
                </div>
            </div>
        </div>
    </div>
        </div>
    </nav>
    <?php
        $result = mysqli_query($link,"SELECT * FROM compra");
    ?>
    <table class="table table-striped" id="categoria">
        <tr class="table table-dark">
            <th>ID</th>
            <th>Data da Compra</th>
            <th>ID do Comprador</th>
            <th>Forma de Pagamento</th>
            <th>Status do Pagamento</th>
            <th>Detalhes da Compra</th>
        </tr>

        <?php while ($linha = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $linha["ID"]?></td>
                <td><?php echo $linha["CRIADO_EM"]?></td>
                <td><?php echo $linha["USUARIO_ID"]?></td>
                <td><?php echo $linha["PGTO_TIPO"]?></td>
                <td><?php echo $linha["PGTO_STATUS"]?></td>
                <td>
                    <a href="detalhes_compra.php?id=<?php echo $linha['ID'] ?>" class="btn btn-outline-primary">
                        Detalhes
                    </a> 
                </td>
            </tr>
        <?php endwhile ?>
    </table>
    
</body>
</html>