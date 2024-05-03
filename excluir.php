<?php
include_once 'conexao.php'; // inclua o arquivo de conexão com o banco de dados

// Verifica se a conexão foi estabelecida corretamente
if ($mysqli === null) {
    die("Erro na conexão com o banco de dados.");
}

// Verifica se o ID do produto a ser excluído foi fornecido via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepara e executa a declaração SQL para excluir o produto com o ID fornecido
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Redireciona de volta para a página anterior após a exclusão
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Erro ao excluir produto: " . $stmt->error;
    }
} else {
    echo "ID do produto a ser excluído não especificado.";
}
?>