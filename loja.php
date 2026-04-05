<?php
session_start();
require_once 'includes/config.php';



$search = $_GET['search'] ?? '';

$sql = "SELECT id, nome, descricao, preco, imagem FROM produtos";
$params = [];

if ($search !== '') {
    $sql .= " WHERE nome LIKE ?";
    $params[] = "%$search%";
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="pt">

<head>
    <title>Jorge e Mateus - Oficial</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Exercicio Final" />
    <meta name="author" content="Anna Gabriela" />
    <meta name="keywords" content="Jorge, Mateus, Discografia, Fotos, Agenda, contatos, banda" />

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />

    <!-- Fontes e icons -->
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/1ce6cd5a3e.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="css/meu-ficheiro.css" />
</head>

<body style="font-weight: 600">
    <header class="bg-dark text-white p-3">
        <div class="container">
            <h1 class="h3 mb-0">Loja Oficial — Jorge & Matheus</h1>
        </div>
        <div class="col-sm-10 nav navbar">
            <img src="photos/Logo.jpg" alt="logo" class="logo" width="75px" />
            <a href="#" class="nav-link p-3 m-2" title="Search"><i class="fa fa-search"></i></a>
            <a href="index.php" class="nav-link active p-3 m-2">HOME</a>
            <a href="SOBRE.html" class="nav-link p-3 m-2">SOBRE</a>
            <a href="loja.php" class="nav-link p-3 m-2">LOJA</a>
            <a href="AGENDA.html" class="nav-link p-3 m-2">AGENDA</a>
            <a href="contacto.html" class="nav-link p-3 m-2">CONTACTOS</a>
            <a href="carrinho.php" class="nav-link p-3 m-2"> <i class="fa fa-shopping-cart"></i></a>
        </div>
    </header>

    <main class="container my-4">
        <!-- Filtro e busca -->
        <form method="get" class="row g-2 align-items-end mb-4">
            <div class="col-md-8">
                <label class="form-label">Procurar produto</label>
                <input type="search" name="search" class="form-control" placeholder="Pesquisar produtos..."
                    value="<?= htmlspecialchars($search) ?>">
            </div>

            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    Procurar
                </button>

                <?php if ($search !== ''): ?>
                <a href="loja.php" class="btn btn-outline-secondary w-100">
                    Ver todos
                </a>
                <?php endif; ?>
            </div>
        </form>

        <?php if ($search !== ''): ?>
        <p class="text-muted">
            Resultados para: <strong><?= htmlspecialchars($search) ?></strong>
        </p>
        <?php endif; ?>



        <!-- Lista de produtos -->
        <section class="row row-cols-1 row-cols-md-3 g-4">

            <?php foreach ($produtos as $p): ?>
            <div class="col">
                <div class="card h-100">
                    <img src="photos/<?= htmlspecialchars($p['imagem']) ?>" class="card-img-top"
                        alt="<?= htmlspecialchars($p['nome']) ?>"
                        onerror="this.src='https://placehold.co/300x200?text=Sem+imagem'">

                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($p['nome']) ?></h5>
                        <p class="card-text" style="color: black"><?= htmlspecialchars($p['descricao']) ?></p>
                        <p class="fw-bold" style="color: black; font-size: 25px">
                            <?= number_format($p['preco'], 2, ',', '.') ?> €
                        </p>

                        <!-- BOTÕES -->
                        <div class="d-flex gap-2">
                            <!-- Ver detalhes (Lightbox) -->
                            <button type="button" class="btn btn-outline-secondary btn-sm view-details"
                                data-image="photos/<?= htmlspecialchars($p['imagem']) ?>"
                                data-title="<?= htmlspecialchars($p['nome']) ?>"
                                data-description="<?= htmlspecialchars($p['descricao']) ?>"
                                data-price="<?= number_format($p['preco'], 2, ',', '.') ?> €">
                                Ver detalhes
                            </button>

                            <!-- Adicionar ao carrinho -->
                            <form action="adicionar-carrinho.php" method="POST">
                                <input type="hidden" name="produto_id" value="<?= $p['id'] ?>">

                                <button type="submit" class="btn btn-primary btn-sm">Adicionar ao Carrinho</button>
                            </form>



                        </div>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>

        </section>

    </main>

    <!-- Lightbox Modal -->

    <div id="lightbox" style="
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 1000;
        justify-content: center;
        align-items: center;
      ">
        <div style="
          position: relative;
          background: #fff;
          padding: 20px;
          max-width: 600px;
          width: 90%;
          border-radius: 8px;
        ">
            <span class="close-btn" style="
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
            font-size: 1.5rem;
          ">&times;</span>
            <h3 id="lightbox-title"></h3>
            <div style="text-align: center; margin-bottom: 10px">
                <img id="lightbox-image" src="" alt="" style="max-width: 100%; max-height: 300px; border-radius: 4px" />
            </div>
            <div id="lightbox-thumbs" style="
            display: flex;
            justify-content: center;
            gap: 5px;
            flex-wrap: wrap;
          "></div>
            <p id="lightbox-description" style="margin-top: 10px"></p>
            <p id="lightbox-price" style="font-weight: bold; margin-top: 5px"></p>
            <div style="text-align: center; margin-top: 10px">
                <button id="prev-img" class="btn btn-sm btn-outline-secondary">
                    Anterior
                </button>
                <button id="next-img" class="btn btn-sm btn-outline-secondary">
                    Próximo
                </button>
            </div>
        </div>
    </div>

    <!-- jQuery (se precisar) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>

    <!-- Lightbox (opcional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/js/lightbox-plus-jquery.js"
        crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript -->
    <script src="js/meu-ficheiro.js"></script>

    <?php
    require_once 'includes/config.php';

    ?>

</body>

</html>