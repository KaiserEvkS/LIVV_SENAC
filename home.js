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
