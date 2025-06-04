
<?php
//incluir os dados da conexao.php
include("conexaoDelivery.php");

//verificar se os campos não nulos 
    if(isset($_POST['descricao']) && isset($_POST['quantidade']) &&
        isset($_POST['preco']) ){
            $descricao  = mysqli_real_escape_string($conexao, $_POST['descricao']);
            $quantidade =  mysqli_real_escape_string($conexao, $_POST['quantidade']);
            $preco =  mysqli_real_escape_string($conexao, $_POST['preco']);
            $id_usuario =  mysqli_real_escape_string($conexao, $_POST['id']);
            $id_produto =  mysqli_real_escape_string($conexao, $_POST['id_produto']);
            $sql = " insert into pedido( descricao, quantidade, preco, usuario, id_produto
            ) values ('$descricao', '$quantidade', '$preco', '$id_usuario','$id_produto')";
            if (mysqli_query($conexao, $sql)){
                echo " <br> Dados salvos no banco de dados";
            }else{
                echo " <br> Erro ao salvar!". mysqli_error($conexao);
            }
        }else{
            echo " Preencha todos os dados";
        }
mysqli_close($conexao);

?>