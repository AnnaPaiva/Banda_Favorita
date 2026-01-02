<?php
include 'includes/config.php';

//Verificar se foi solicitada uma categoria específica
$categoria_id = isset($_GET['categoria']) ? (int) $_GET['categoria'] : 0;

//Procurar por todas as categorias para o menu
$queryCategorias = $pdo->query("SELECT * from categorias");

//Obter os resultados
$categorias = $queryCategorias->fetchAll(PDO::FETCH_ASSOC);


//Consulta para obter os produtos (todos filtrados por categoria)
$sql = "SELECT p.*, c.nome AS categoria_nome FROM produtos p LEFT JOIN categorias c ON p.categoria_id = c.id";


//adicionar o filtro a consulta sql, quando a categoria especifica é selecionada
$params = [];
if ($categoria_id > 0) {
    $sql .= " WHERE p.categoria_id = ?";
    $params[] = $categoria_id;
}

$sql .= " ORDER BY p.nome";

$query = $pdo->prepare($sql);
$query->execute($params);


//consulta para obter os produtos
// $query = $pdo->query("SELECT * FROM produtos");
$produtos = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Online</title>
    <!-- Incluindo o Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-5">

        <!-- Formulário de Filtro por categorias -->

        <form method="get" action="index.php" class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <label for="categoria" class="form-label">Filtrar por categoria</label>
                    <select class="form-select" id="categoria" name="categoria" onchange="this.form.submit()">
                        <option value="0">Todas as categorias</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= $categoria_id == $cat['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </form>

        <!-- Listagem de produtos -->
        <div class="row">
            <?php foreach ($produtos as $produto): ?>
                <div class="col-md-4">
                    <div class="card">
                        <?php if ($produto['imagem']): ?>
                            <img src="imagens/<?php echo $produto['imagem']; ?>" class="card-img-top"
                                alt="<?php echo $produto['nome']; ?>">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Imagem não disponível">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $produto['nome']; ?></h5>
                            <p class="card-text"><?php echo $produto['descricao']; ?></p>
                            <p class="card-text"><strong>Preço:</strong>
                                €<?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>

                            <!-- alterações feitas aqui -->

                            <button class="btn btn-primary adicionar-carrinho" data-id="<?= $produto['id'] ?>">
                                Adicionar ao carrinho</button>

                            <!-- fim alterações -->


                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const botoes = document.querySelectorAll('.adicionar-carrinho');

            botoes.forEach(botao => {
                botao.addEventListener('click', function() {
                    const idProduto = this.getAttribute('data-id');

                    fetch('adicionar_ao_carrinho.php?id=' + idProduto)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Atualizar o número no ícone do carrinho
                                document.getElementById('carrinho-contador').textContent = data
                                    .total;


                                alert(data.mensagem);
                            } else {
                                alert('Erro: ' + data.error);
                            }
                        })
                        .catch(error => {
                            console.error('Erro na requisição:', error);
                            alert('Erro ao adicionar ao carrinho.');
                        });
                });
            });
        });
    </script>

</body>

</html>