<style>
.sidebar {
    width: 250px;
    height: 100vh;
    background-color: #333030;
    position: fixed;
    top: 0;
    left: 0;
    padding-top: 20px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
}

.sidebar h2 {
    text-align: center;
    color: #e8e2e2;
    margin-bottom: 30px;
    font-size: 26px;
}

.sidebar a {
    display: block;
    padding: 15px 20px;
    color: #e8e2e2;
    text-decoration: none;
    font-size: 18px;
    transition: 0.3s;
}

.sidebar a:hover {
    background-color: #4a4646;
    padding-left: 30px;
}

.content {
    margin-left: 260px;
    padding: 20px;
}
</style>

<div class="sidebar">
    <h2>Admin</h2>

    <a href="dashboard.php">Dashboard</a>

    <a href="produtos.php">Produtos</a>
    <a href="adicionar_produto.php">Adicionar Produto</a>
    <a href="editar_produto.php">Editar Produto</a>

    <a href="encomendas.php">Encomendas</a>

    <a href="event_details.php">Detalhes dos Eventos</a>
    <a href="event_sales_summary.php">Resumo de Vendas por Evento</a>
    <a href="customer_sales_summary.php">Resumo de Clientes</a>
    <a href="tickets_status.php">Status dos Bilhetes</a>

    <a href="utilizadores.php">Utilizadores</a>
</div>

<div class="content">