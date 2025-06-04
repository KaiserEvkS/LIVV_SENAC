<?php
include("conexaoDelivery.php");

// Consulta separada para produtos
/*
$sqlProdutos = "SELECT id_produto,  nome_produto FROM produtos";
$resultProdutos = $conexao->query($sqlProdutos);*/

$sqlProdutos = "SELECT id_produto, nome_produto, preco_produto FROM produtos";
$resultProdutos = $conexao->query($sqlProdutos);

// Consulta separada para usuários
$sqlUsuarios = "SELECT id, nome FROM users";
$resultUsuarios = $conexao->query($sqlUsuarios);


?>


<form name="produto" id="produto" method="post" action="cadastroPedido2.php">

    <div>
        <label for="descricao">Descrição: </label>
        <input type="text" name="descricao" id="descricao">
    </div>

    <div>
        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" id="quantidade">
    </div>
    <div>
        <label for="id_produto">Produto:</label>
        <select name="id_produto" id="id_produto" required>
            <option value="">Selecione:</option>
            <?php
            if ($resultProdutos->num_rows > 0) {
                while ($row = $resultProdutos->fetch_assoc()) {
                   echo "<option value='" . $row["id_produto"] . "' data-preco='" . $row["preco_produto"] . "'>" .
                        htmlspecialchars($row["nome_produto"]) . "</option>";
                  /*  echo "<option value='" . $row["id_produto"] . "'>" .
                        htmlspecialchars($row["nome_produto"]) . "</option>";*/
                }
            } else {
                echo "<option value=''>Nada encontrado!</option>";
            }
            ?>
        </select>
    </div>

    <div>
    <label for="preco">Preço:</label>
    <input type="text" name="preco" id="preco" readonly onclick="calcularPreco()" placeholder="Clique para obter o Valor R$">
</div>

        <div>
        <label for="id_usuario">Usuário:</label>
        <select name="id" id="id" required>
            <option value="">Selecione:</option>
            <?php
            if ($resultUsuarios->num_rows > 0) {
                while ($row = $resultUsuarios->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" .
                        htmlspecialchars($row["nome"]) . "</option>";
                }
            } else {
                echo "<option value=''>Nada encontrado!</option>";
            }
            ?>
        </select>
        </div>

        <button type="submit" name="enviar" value="Cadastrar">Enviar</button>
        <button type="reset" name="limpar" value="resetar">Limpar</button>

</form>

<script>
function calcularPreco() {
    const selectProduto = document.getElementById("id_produto");
    const quantidade = parseInt(document.getElementById("quantidade").value);
    const precoCampo = document.getElementById("preco");

    const opcaoSelecionada = selectProduto.options[selectProduto.selectedIndex];
    const precoUnitario = parseFloat(opcaoSelecionada.getAttribute("data-preco"));

    if (!isNaN(precoUnitario) && !isNaN(quantidade)) {
        const precoTotal = precoUnitario * quantidade;
        precoCampo.value = precoTotal.toFixed(2);
    } else {
        precoCampo.value = "";
        alert("Selecione um produto e insira a quantidade primeiro.");
    }
}
</script>

<footer>
            &copy; 2025 Canes Foods. Todos os direitos reservados.
     
            <div class="telefone">
    <img src="" alt="">
    <div class="descricao">
        <h2>entre em contato conosco</h2>
        <p>nosso horário de atentimento é de segunda a sexta das 07:00h as 12:00h e das 13:00h as 17:00h
            e no sabado das 07:00h as 12:00h. <br><br> 
            45 988431516 <br><br>
            CanesDelivery@gmail.com
        </p>
       
   </div>
       
</div>