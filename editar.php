<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Produto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        form {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        ul li {
            margin-bottom: 10px;
        }

        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            resize: vertical;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
            margin-top: auto;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>

    <form method="post" action="atualizar.php">
        <?php
        include_once 'conexao.php'; // inclua o arquivo de conexão com o banco de dados

        // Verifica se a conexão foi estabelecida corretamente
        if ($mysqli === null) {
            die("Erro na conexão com o banco de dados.");
        }

        // Verifica se o ID foi passado via GET
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Consulta o registro com o ID fornecido
            $sql = "SELECT * FROM produtos WHERE id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                // Exibe um formulário pré-preenchido com os dados do registro
        ?>
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <ul>
                    <li><textarea name="nome"><?php echo $row['nome']; ?></textarea></li>
                    <li><textarea name="valor"><?php echo $row['valor']; ?></textarea></li>
                    <li><textarea name="quantidade"><?php echo $row['quantidade']; ?></textarea></li>
                    <li><textarea name="descricao"><?php echo $row['descricao']; ?></textarea></li>
                </ul>
                <div class="center">
                    <button type="submit">Atualizar</button>
                </div>
        <?php
            } else {
                echo "Produto não encontrado.";
            }
        } else {
            echo "ID do produto não especificado.";
        }
        ?>
    </form>

</body>

</html>