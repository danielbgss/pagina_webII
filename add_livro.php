<?php
     $link = mysqli_connect("localhost:3306", "root", "");
     $select = mysqli_select_db($link, "loja_digital");
    if (!$select) {
        echo "O Banco de Dados não foi encontrado.";
        die();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = mysqli_real_escape_string($link, $_POST['ID']);
        $nome = mysqli_real_escape_string($link, $_POST['NOME']);
        $descricao = mysqli_real_escape_string($link, $_POST['CRIADO_EM']);
        $criadoem = mysqli_real_escape_string($link, $_POST['ATIVO']);
        $valor = mysqli_real_escape_string($link, $_POST['USUARIO_ID']);


        try {
        if(!is_numeric($preco)) throw new Exception("Preço não é um número");


        $sql = "INSERT INTO arquivo_digital(ID,NOME,CRIADO_EM,ATIVO,VALOR) VALUES('$nome','$descricao','$preco','$estoque')";
        mysqli_query($link, $sql);
        echo "Produto registrado com sucesso";
        echo "<a href='inserir_produto.php'>Voltar</a>";
        die;
    }catch(Exception $ex) {
        echo "$ex";die;
    }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Livros</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <header>
    <nav class="navbar sticky-top navbar-expand-lg navbar bg-secondary">
        <div class="container-fluid">
            <div class="container-fluid text-center">
            <div class="row">
            <div class="col-md-2">
                <a href="index.php" class="btn btn-dark mt-3">Voltar</a>
            </div>
            <div class="col-md-8">
                <div class="container-md">
                    <h1>Adicionar Livro</h1>
                </div>
            </div>
        </div>
    </div>
        </div>
    </nav>
    </header>
    


    <div class="d-flex justify-content-center align-items-center">         
            <div class="card m-3 w-50">
                <div class="card-body">
                    <h6 class="card-title fw-bolder">Adicionar Novo Livro</h6>
                    <h7 class="card-subtitle mb-2 text-body-secondary">Preencha os campos abaixo</h7>
                    <form method="POST" action="#">
                        <div class="row mb-3 mt-4">
                            <div class="col-md-6">
                                <h6 class="fw-bolder">Nome</h6>
                                <textarea class="form-control" rows="3" placeholder="Informe o nome do livro..."></textarea>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bolder">Observações</h6>
                                <textarea class="form-control" rows="3" placeholder="Descreva o conteúdo do livro..."></textarea>
                            </div>
                        </div>
                        <div class="row mb-3 mt-4">
                            <div class="col-md-6">
                                <h6 class="fw-bolder">Observações</h6>
                                <textarea class="form-control" rows="3" placeholder="Descreva brevemente o motivo da consulta ou informações relevantes..."></textarea>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bolder">Observações</h6>
                                <textarea class="form-control" rows="3" placeholder="Descreva brevemente o motivo da consulta ou informações relevantes..."></textarea>
                            </div>
                        </div>
                        <div class="row mb-3 mt-4">
                            <div class="col-md-12">
                                <h6 class="fw-bolder">Observações</h6>
                                <textarea class="form-control" rows="3" placeholder="Descreva brevemente o motivo da consulta ou informações relevantes..."></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-dark me-3">Cancelar</button>
                            <button type="submit" class="btn btn-success">Agendar Consulta</button>
                    </form>
                </div>            
            </div>
        </div>
</body>
</html>