<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Materiais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos adicionais */
        body {
            min-height: 10vh;
            width: auto;
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="mt-3">Lista de Materiais</h2>
        <table class="table table-striped table-bordered mt-3">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Quantidade</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once 'conexao.php'; // inclua o arquivo de conexão com o banco de dados

                // Verifica se a conexão foi estabelecida corretamente
                if ($mysqli === null) {
                    die("Erro na conexão com o banco de dados.");
                }

                // Consulta os materiais no banco de dados
                $sql = "SELECT * FROM produtos";
                $result = $mysqli->query($sql);

                if (!$result) {
                    die("Erro ao executar a consulta: " . $mysqli->error);
                }

                // Itera sobre os resultados da consulta e exibe os materiais em uma tabela
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>R$ " . $row["valor"] . "</td>";
                    echo "<td>" . $row["quantidade"] . "</td>";
                    echo "<td>" . $row["descricao"] . "</td>";
                    echo "<td>";
                    echo "<a href='editar.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm'>Editar</a>";
                    echo "<button onclick='confirmarExclusao(" . $row["id"] . ")' class='btn btn-danger btn-sm ms-1'>Excluir</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="painel.php" class="btn btn-outline-success">Voltar ao Painel</a>
    </div>

    <script>
        function confirmarExclusao(id) {
            if (confirm("Tem certeza de que deseja excluir este item?")) {
                window.location.href = "excluir.php?id=" + id;
            }
        }
    </script>
</body>

</html>