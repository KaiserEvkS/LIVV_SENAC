<?php
session_start();
include("conexaoDelivery.php");

// Simulando sessão de usuário (remova se não precisar)
$usuario = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produto'])) {
    $id_produto = intval($_POST['id_produto']);

    // Buscar dados do produto
    $sql_produto = "SELECT nome_produto, preco_produto FROM produtos WHERE id_produto = ?";
    $stmt = mysqli_prepare($conexao, $sql_produto);
    mysqli_stmt_bind_param($stmt, "i", $id_produto);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $produto = mysqli_fetch_assoc($result);

    if ($produto) {
        $nome = $produto['nome_produto'];
        $preco = $produto['preco_produto'];
        $quantidade = 1; // você pode ajustar isso com input depois

        // Inserir pedido na nova estrutura da tabela
        $sql_insert = "INSERT INTO tb_pedido (nome_produto, preco, quantidade)
                       VALUES (?, ?, ?)";
        $stmt_insert = mysqli_prepare($conexao, $sql_insert);
        mysqli_stmt_bind_param($stmt_insert, "sdi", $nome, $preco, $quantidade);
        mysqli_stmt_execute($stmt_insert);

        header("Location: selectIMG.php?msg=adicionado");
        exit;
    } else {
        echo "Produto não encontrado.";
    }
} else {
    echo "Requisição inválida.";
}
?>
