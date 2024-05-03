<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "login";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];
    $descricao = $_POST['descricao'];

    if (empty($nome) || empty($valor) || empty($quantidade) || empty($descricao)) {
        echo '<script>alert("Por favor, preencha todos os campos.");</script>';
    } else {

        $sql = "INSERT INTO produtos (nome, valor, quantidade, descricao) VALUES ('$nome', '$valor', '$quantidade', '$descricao')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Registro salvo com sucesso!");</script>';
        } else {
            echo '<script>alert("Erro ao salvar registro: ' . $conn->error . '");</script>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="text-center">
    

    <h1 class="display-1">Cadastro de Materiais</h1>
    <div class="row mt-3">

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-3">
                    <img src="Imagens/box-open-full.png" width="150" height="150" alt="produto" class="img-produtos">
                </div>
            </div>

            <div class="col-8 mx-auto">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="container">
                        <div class="card">
                            <div class="card-body bg-primary">
                                <div class="mt-3 form-floating">
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do produto">
                                    <label for="nome" class="form-label">Nome do produto.</label>
                                </div>

                                <div class="mt-3 form-floating">
                                    <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor em R$">
                                    <label for="valor" class="form-label">Valor em R$.</label>
                                </div>

                                <div class="mt-3 form-floating">
                                    <input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade">
                                    <label for="quantidade" class="form-label">Quantidade.</label>
                                </div>

                                <div class="mt-3 form-floating">
                                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição">
                                    <label for="descricao" class="form-label">Descrição.</label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mt-3 form-floating">
                        <div class="row">

                            <div class="col">
                                <button type="submit" class="btn btn-info">
                                    Salvar Registro.
                                </button>
                                <a href="lista_materiais.php" class="btn btn-primary">Lista de Materiais</a>
                                <button type="button" class="btn btn-danger" onclick="confirmarSaida()">Sair do Sistema</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmarSaida() {
            if (confirm("Deseja realmente sair?")) {
                window.location.href = "logout.php"; // Redireciona para logout.php se confirmado
            }
        }
    </script>
</body>

</html>