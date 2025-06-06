 <?php
include("conexaoDelivery.php");

// Buscar os dados dos produtos
$sql = "SELECT tipo_produto, nome_produto, preco_produto, img_produto FROM produtos";
$result = mysqli_query($conexao, $sql);

// Verifica se há resultados
$produtos = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $produtos[] = $row;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Produtos Cadastrados</title>
</head>
<body>
    <h1>Lista de Produtos</h1>
    <?php if (!empty($produtos)): ?>
        <?php foreach ($produtos as $produto): ?>
            <div style="margin-bottom: 30px; border: 1px solid #ccc; padding: 15px; width: 320px;">
                <p><strong>Tipo:</strong> <?= htmlspecialchars($produto['tipo_produto']) ?></p>
                <p><strong>Nome:</strong> <?= htmlspecialchars($produto['nome_produto']) ?></p>
                <p><strong>Preço:</strong> R$ <?= htmlspecialchars($produto['preco_produto']) ?></p>
                <img src="<?= htmlspecialchars($produto['img_produto']) ?>" alt="Imagem do Produto" width="300">
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum produto cadastrado ainda.</p>
    <?php endif; ?>
</body>
</html>
