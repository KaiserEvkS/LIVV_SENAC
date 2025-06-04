<?php
include("conexaoDelivery.php");
// Verifica se o arquivo enviado
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
    $nome = $_POST['nome'];
    $imagem = $_FILES['imagem'];
    // Pasta para salvar as imagens
    $pasta = "uploads/";
    if (!is_dir($pasta)) {
        mkdir($pasta, 0755, true);
    }
    $nomeImagem = uniqid() . "-" . basename($imagem['name']);
    $caminhoCompleto = $pasta . $nomeImagem;
    if (move_uploaded_file($imagem['tmp_name'], $caminhoCompleto)) {
        // Salvar nome e caminho no banco
        $sql = "INSERT INTO fotos (nome, caminho) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $caminhoCompleto]);
        echo "Imagem enviada com sucesso!";
    } else {
        echo "Erro ao mover o arquivo.";
    }
} else {
    echo "Nenhuma imagem enviada.";
}
?>




<?php
include('conexaoDelivery.php');
// Buscar as imagens do banco
$sql = "SELECT nome, caminho FROM fotos";
$stmt = $pdo->query($sql);
$imagens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Imagens Salvas</title>
</head>

<body>
    <h1>Galeria de Imagens</h1>
    <?php foreach ($imagens as $img): ?>
        <div style="margin-bottom: 20px;">
            <p><strong><?= htmlspecialchars($img['nome']) ?></strong></p>
            <img src="<?= htmlspecialchars($img['caminho']) ?>" alt="Imagem" width="300">
        </div>
    <?php endforeach; ?>
</body>

</html>