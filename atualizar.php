<?php
include_once 'conexao.php'; // inclua o arquivo de conexão com o banco de dados

// Verifica se a conexão foi estabelecida corretamente
if ($mysqli === null) {
    die("Erro na conexão com o banco de dados.");
}

// Verifica se o formulário foi submetido e se os campos necessários foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'], $_POST['nome'], $_POST['valor'], $_POST['quantidade'], $_POST['descricao'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];
    $descricao = $_POST['descricao'];

    // Atualiza os dados no banco de dados
    $sql = "UPDATE produtos SET nome = ?, valor = ?, quantidade = ?, descricao = ? WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssisi", $nome, $valor, $quantidade, $descricao, $id);

    if ($stmt->execute()) {
        // Redireciona de volta para a página de painel após a atualização
        header("Location: lista_materiais.php");
        exit();
    } else {
        echo "Erro ao atualizar registro: " . $stmt->error;
    }
} else {
    echo "Por favor, envie todos os campos necessários.";
}
?>
