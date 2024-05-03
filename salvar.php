<?php
// Verifica se todos os campos obrigatórios foram enviados
if (isset($_GET['nome'], $_GET['valor'], $_GET['quantidade'], $_GET['descricao'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "login";

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Processa os dados do formulário
    $nome = $_GET['nome'];
    $valor = $_GET['valor'];
    $quantidade = $_GET['quantidade'];
    $descricao = $_GET['descricao'];

    // Verifica se os campos obrigatórios não estão vazios
    if (!empty($nome) && !empty($valor) && !empty($quantidade)) {
        // Insere os dados no banco de dados
        $sql = "INSERT INTO produtos (nome, valor, quantidade, descricao) VALUES ('$nome', '$valor', '$quantidade', '$descricao')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro salvo com sucesso!";
            // Redireciona para evitar envio de formulário repetido
            header("Location: painel.php");
            exit(); // Termina o script após o redirecionamento
        } else {
            echo "Erro ao salvar registro: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos obrigatórios.";
    }

    // Fecha a conexão
    $conn->close();
} else {
    echo "Por favor, preencha todos os campos do formulário.";
}
?>


