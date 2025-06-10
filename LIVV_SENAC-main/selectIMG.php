<?php
include("conexaoDelivery.php");

// Buscar os dados dos produtos
$sql = "SELECT id_produto, tipo_produto, nome_produto, preco_produto, img_produto FROM produtos";
$result = mysqli_query($conexao, $sql);

$produtos = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $produtos[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produtos Cadastrados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .produto-form {
            border: none;
            background: none;
            padding: 0;
            margin: 0;
            width: 100%;
        }

        .produto-form button {
            all: unset;
            width: 100%;
            cursor: pointer;
        }

        .produto-form .card:hover {
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            transform: scale(1.02);
            transition: 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <h1 class="mb-4">Clique no produto para adicionar ao pedido</h1>

        <?php if (!empty($produtos)): ?>
            <div class="row">
                <?php foreach ($produtos as $produto): ?>
                    <div class="col-md-4 mb-4">
                        <form class="produto-form" method="POST" action="adicionarPedidos.php">
                            <input type="hidden" name="id_produto" value="<?= $produto['id_produto'] ?>">
                            <button type="submit">
                                <div class="card h-100">
                                    <img src="<?= htmlspecialchars($produto['img_produto']) ?>" class="card-img-top" alt="Imagem do Produto">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($produto['nome_produto']) ?></h5>
                                        <p class="card-text"><strong>Tipo:</strong> <?= htmlspecialchars($produto['tipo_produto']) ?></p>
                                        <p class="card-text"><strong>Preço:</strong> R$ <?= htmlspecialchars($produto['preco_produto']) ?></p>
                                    </div>
                                </div>
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted">Nenhum produto cadastrado ainda.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
