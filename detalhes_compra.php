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
    <title>Detalhes da Compra</title>
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
                    <h1>Detalhes da Compra</h1>
                </div>
            </div>
        </div>
    </div>
        </div>
    </nav>
    <?php 
        $id_compra = mysqli_real_escape_string($link, $_GET["id"]);
        $result = mysqli_query($link, "SELECT arq.ID as id_arquivo, NOME, cad.VALOR FROM arquivo_digital arq INNER JOIN compra_arquivo_digital cad ON arq.ID = cad.ARQUIVO_DIGITAL_ID WHERE cad.COMPRA_ID = $id_compra");
        $estado = mysqli_query($link, "SELECT c.PGTO_STATUS as arq_status FROM compra c WHERE C.ID = $id_compra");
        $resultado_total = mysqli_query($link, "SELECT SUM(VALOR) as total FROM compra_arquivo_digital WHERE COMPRA_ID = $id_compra");
        $linha_total = mysqli_fetch_assoc($resultado_total);
        $total = $linha_total['total'];
    ?>
    <div class="container-fluid text-center">
        <div class="row align-items-start">
            <div class="col-md-8">
                <table class="table table-striped"id="categoria">
                    <tr class="table table-dark">
                        <th>ID</th>
                        <th>Livros</th>
                        <th>Preço Unitário</th>
                    </tr>
                <?php while ($linha = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $linha["id_arquivo"] ?></td>
                        <td><?php echo $linha["NOME"] ?></td>
                        <td><?php echo $linha["VALOR"] ?></td>
                    </tr>
                <?php endwhile ?>
                </table>        
            </div> <!-- ESQUERDA -->
            
            <?php $estado_compra = mysqli_fetch_assoc($estado); ?>

            <div class="col-md-4 card text-center" id="direito">
                
                    <div class="card-body" id="corpo_card">
                        <h1 class="card-title" id="titulo_card">Total</h1>
                        <p class="card-text" id="texto_card">R$
                            <?php echo $total; ?>
                        </p>
                        <?php if ($estado_compra["arq_status"] == "PAGO") {
                            echo '<div class="p-3 bg-success border border-light rounded-3">
                                    <h4>Pagamento Aprovado</h4>
                                </div>';
                        }else if ($estado_compra["arq_status"] == "NEGADO") {
                            echo '<div class="p-3 bg-danger border border-light rounded-3">
                                    <h4>Pagamento Negado</h4>
                                </div>';
                        }else {
                            echo '<div class="p-3 bg-warning border border-light rounded-3">
                                    <h4>Pagamento em Processamento</h4>
                                </div>';
                        }

                        ?>
                    </div>
                
            </div>
        </div>
    </div>
</body>
</html>