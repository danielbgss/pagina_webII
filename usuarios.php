<?php
     $link = mysqli_connect("localhost:3306", "root", "");
     $select = mysqli_select_db($link, "loja_digital");
    if (!$select) {
        echo "O Banco de Dados não foi encontrado.";
        die();
    }
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários</title>
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
                    <h1>Lista de Usuários</h1>
                </div>
            </div>
        </div>
    </div>
        </div>
    </nav>
    
        <?php
            $result = mysqli_query($link, "SELECT * FROM USUARIO");
            if (isset($_GET["id"])) {
                $id_usuario = mysqli_real_escape_string($link, $_GET["id"]);
                $deletar = mysqli_query($link, "UPDATE USUARIO SET ATIVO = 'NÃO' WHERE ID = $id_usuario");
            }
        ?>
        <table class="table table-striped" id="categoria">
            <tr class="table table-dark">
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>Ativo</th>
                <th></th>
            </tr>
            
            <?php while ($linha = mysqli_fetch_assoc($result)): ?>
                <?php if ($linha["ATIVO"] == 'SIM'): ?>
                    <tr>
                    <td><?php echo $linha["ID"] ?></td>
                    <td><?php echo $linha["NOME"] ?></td>
                    <td><?php echo $linha["EMAIL"] ?></td>
                    <td><?php echo $linha["TIPO"] ?></td>
                    <td><?php 
                            if ($linha["ATIVO"] == 'SIM') {
                                echo "✔️";
                            }else {
                                echo "❌";
                            } 
                        ?>
                     </td>
                    <td>
                        <a href="usuarios.php?id=<?php echo $linha['ID']; ?>" class="btn btn-danger">Deletar</a>
                    </td>
                </tr>
                <?php endif; ?>
                            
            <?php endwhile ?>
            <?php 

            ?>
            
        </table>
    
        
        
</body>
</html>