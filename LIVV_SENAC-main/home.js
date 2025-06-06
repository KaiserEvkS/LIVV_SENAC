document.addEventListener('DOMContentLoaded', function() {
  function carregarConteudo(url) {
    fetch(url)
      .then(response => {
        if (!response.ok) throw new Error('Erro ao carregar a página');
        return response.text();
      })
      .then(html => {
        document.getElementById('conteudo').innerHTML = html;
      })
      .catch(error => {
        console.error(error);
        document.getElementById('conteudo').innerHTML = '<p>Erro ao carregar o conteúdo.</p>';
      });
  }

  document.getElementById('link-produtos').addEventListener('click', function(e) {
    e.preventDefault();
    carregarConteudo('produtos.html');
  });

  document.getElementById('link-sobre').addEventListener('click', function(e) {
    e.preventDefault();
    carregarConteudo('sobre.html');
  });

  document.getElementById('link-contato').addEventListener('click', function(e) {
    e.preventDefault();
    carregarConteudo('contato.html');
  });

  document.getElementById('link-pedidos').addEventListener('click', function(e) {
    e.preventDefault();
    carregarConteudo('pedidos.html');
  });
});

// função de quando selecionar o item o mesmo ir para tela de pedido
   let order = {};

    function addToOrder(itemName, price) {
      if (order[itemName]) {
        order[itemName].quantity++;
      } else {
        order[itemName] = {
          price: price,
          quantity: 1
        };
      }
      renderOrder();
    }

    function changeQuantity(itemName, amount) {
      if (order[itemName]) {
        order[itemName].quantity += amount;
        if (order[itemName].quantity <= 0) {
          delete order[itemName];
        }
      }
      renderOrder();
    }

    function renderOrder() {
      const orderDiv = document.getElementById('order');
      orderDiv.innerHTML = '';
      let total = 0;

      for (const itemName in order) {
        const item = order[itemName];
        const subtotal = item.quantity * item.price;
        total += subtotal;

        const div = document.createElement('div');
        div.innerHTML = `
          ${itemName} - Quantidade: ${item.quantity} 
          - Subtotal: R$${subtotal.toFixed(2)}
          <button onclick="changeQuantity('${itemName}', 1)">+</button>
          <button onclick="changeQuantity('${itemName}', -1)">-</button>
        `;
        orderDiv.appendChild(div);
      }

      const totalDiv = document.createElement('div');
      totalDiv.innerHTML = `<strong>Total do Pedido: R$${total.toFixed(2)}</strong>`;
      orderDiv.appendChild(totalDiv);
    }

    function finalizeOrder() {
      if (Object.keys(order).length === 0) {
        alert("O pedido está vazio!");
        return;
      }

      let resumo = "Resumo do Pedido:\n";
      let total = 0;

      for (const itemName in order) {
        const item = order[itemName];
        const subtotal = item.quantity * item.price;
        resumo += `${itemName} - ${item.quantity} x R$${item.price.toFixed(2)} = R$${subtotal.toFixed(2)}\n`;
        total += subtotal;
      }

      resumo += `\nTotal: R$${total.toFixed(2)}\nPedido finalizado!`;
      alert(resumo);

      order = {};
      renderOrder();
    }