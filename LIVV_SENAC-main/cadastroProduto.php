 <?php
include("conexaoDelivery.php");

// Verifica se os dados foram enviados
if (isset($_POST['tipoprod'], $_POST['nome'], $_POST['preco'], $_FILES['imagem'])) {
    // Escapar os dados recebidos via POST
    $tipoprod = mysqli_real_escape_string($conexao, $_POST['tipoprod']); 
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']); 
    $preco = mysqli_real_escape_string($conexao, $_POST['preco']); 

    // Lida com o upload da imagem
    $imagem = $_FILES['imagem'];
    $pasta = "imagem/";

    if (!is_dir($pasta)) {
        mkdir($pasta, 0755, true);
    }

    $nomeImagem = uniqid() . "-" . basename($imagem['name']);
    $caminhoCompleto = $pasta . $nomeImagem;

    if (move_uploaded_file($imagem['tmp_name'], $caminhoCompleto)) {
        // Caminho salvo no banco de dados
        $img = mysqli_real_escape_string($conexao, $caminhoCompleto);

        // Inserir dados na tabela do produto
        $sql = "INSERT INTO produtos (tipo_produto, nome_produto, preco_produto, img_produto)
                VALUES ('$tipoprod', '$nome', '$preco', '$img')";

        if (mysqli_query($conexao, $sql)) {
            echo "<script> alert('Dados do produto salvos com sucesso');
                  window.location.href='home.html'; </script>";
        } else {
            echo "<br>Erro ao salvar no banco de dados: " . mysqli_error($conexao);
        }

    } else {
        echo "Erro ao mover o arquivo de imagem.";
    }

} else {
    echo "Dados incompletos ou imagem não enviada.";
}
?>
