<?php
session_start();
include("conexaoDelivery.php");

// Simule o ID do usuário (substitua por $_SESSION['usuario'] ou similar no sistema real)
$usuario = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produto'])) {
    $id_produto = intval($_POST['id_produto']);

    // Buscar os dados do produto
    $sql_produto = "SELECT nome_produto, preco_produto FROM produtos WHERE id_produto = ?";
    $stmt = mysqli_prepare($conexao, $sql_produto);
    mysqli_stmt_bind_param($stmt, "i", $id_produto);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $produto = mysqli_fetch_assoc($result);

    if ($produto) {
        $descricao = $produto['nome_produto'];
        $preco = $produto['preco_produto'];
        $quantidade = 1; // você pode alterar conforme quiser

        // Inserir pedido
        $sql_insert = "INSERT INTO pedidos (id_produto, descricao, quantidade, preco, usuario)
                       VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($conexao, $sql_insert);
        mysqli_stmt_bind_param($stmt_insert, "isidi", $id_produto, $descricao, $quantidade, $preco, $usuario);
        mysqli_stmt_execute($stmt_insert);

        header("Location: selectIMG.php?msg=adicionado");
        exit;
    } else {
        echo "Produto não encontrado.";
    }
} else {
    echo "Requisição inválida.";
}
