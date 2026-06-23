<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include "conectar.php";

$totalProdutos = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM produtos"));
$totalEstoque = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(estoque) AS total FROM produtos"));
$entradas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM movimentacoes WHERE tipo='ENTRADA'"));
$saidas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM movimentacoes WHERE tipo='SAIDA'"));
$estoqueBaixo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM produtos WHERE estoque <= 5"));
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>FindWare</title>

<link rel="stylesheet" href="assets/style.css">
<script src="assets/tema.js" defer></script>

<style>
.indicadores {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 16px;
    margin-bottom: 28px;
}

.card-indicador {
    background: white;
    border: 1px solid #d5dbe3;
    border-radius: 8px;
    padding: 20px;
}

.card-indicador h3 {
    font-size: 14px;
    color: #64748b;
    margin-bottom: 10px;
}

.numero {
    font-size: 32px;
    font-weight: bold;
    color: #17202c;
}

.numero.entrada {
    color: #166534;
}

.numero.saida {
    color: #991b1b;
}

.numero.alerta {
    color: #b45309;
}

.area-menu {
    background: white;
    border: 1px solid #d5dbe3;
    border-radius: 8px;
    padding: 25px;
}

.area-menu h2 {
    font-size: 22px;
    margin-bottom: 8px;
    color: #111827;
}

.area-menu p {
    color: #64748b;
    margin-bottom: 20px;
}

.menu-operacoes {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
}

.item-menu {
    background: #f9fafb;
    border: 1px solid #d5dbe3;
    padding: 18px;
    text-decoration: none;
    color: #111827;
    font-weight: bold;
    border-radius: 8px;
    transition: 0.2s;
}

.item-menu:hover {
    background: #e5e7eb;
    transform: translateY(-2px);
}

.rodape {
    margin-top: 18px;
    font-size: 13px;
    color: #64748b;
}

.topo-acoes {
    display: flex;
    align-items: center;
    gap: 14px;
}

.usuario-logado {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.14);
    padding: 10px 16px;
    border-radius: 999px;
    display: flex;
    align-items: center;
    gap: 8px;
    color: white;
}

.usuario-label {
    color: #cbd5e1;
    font-size: 13px;
}

.usuario-logado strong {
    color: white;
    font-size: 14px;
    font-weight: 700;
}

.menu-config {
    position: relative;
}

.btn-menu {
    width: 44px;
    height: 44px;
    padding: 0;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.14);
    background: rgba(255, 255, 255, 0.08);
    color: white;
    font-size: 22px;
    cursor: pointer;
}

.btn-menu:hover {
    background: rgba(255, 255, 255, 0.16);
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 52px;
    right: 0;
    width: 180px;
    background: white;
    border: 1px solid #d5dbe3;
    border-radius: 8px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    z-index: 10;
}

.dropdown-menu.ativo {
    display: block;
}

.dropdown-menu button,
.dropdown-menu a {
    width: 100%;
    display: block;
    padding: 13px 16px;
    border: none;
    background: white;
    color: #17202c;
    text-align: left;
    text-decoration: none;
    font-weight: bold;
    cursor: pointer;
    font-size: 14px;
}

.dropdown-menu button:hover,
.dropdown-menu a:hover {
    background: #f3f4f6;
}

body.tema-escuro .card-indicador,
body.tema-escuro .area-menu {
    background: #111827;
    border-color: #334155;
}

body.tema-escuro .area-menu h2,
body.tema-escuro .card-indicador h3,
body.tema-escuro .numero {
    color: white;
}

body.tema-escuro .area-menu p,
body.tema-escuro .rodape {
    color: #cbd5e1;
}

body.tema-escuro .item-menu {
    background: #1f2937;
    color: white;
    border-color: #334155;
}

body.tema-escuro .item-menu:hover {
    background: #334155;
}

body.tema-escuro .dropdown-menu {
    background: #111827;
    border-color: #334155;
}

body.tema-escuro .dropdown-menu button,
body.tema-escuro .dropdown-menu a {
    background: #111827;
    color: white;
}

body.tema-escuro .dropdown-menu button:hover,
body.tema-escuro .dropdown-menu a:hover {
    background: #1f2937;
}

@media(max-width: 1100px) {
    .indicadores {
        grid-template-columns: repeat(2, 1fr);
    }

    .menu-operacoes {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media(max-width: 650px) {
    .indicadores,
    .menu-operacoes {
        grid-template-columns: 1fr;
    }

    .topo {
        align-items: flex-start;
    }

    .topo-acoes {
        width: 100%;
        justify-content: space-between;
    }
}
</style>
</head>

<body>

<div class="topo">
    <div>
        <h1>FindWare</h1>
        <span>Sistema Inteligente de Localização de Produtos</span>
    </div>

    <div class="topo-acoes">

        <div class="usuario-logado">
            <span class="usuario-label">Usuário:</span>
            <strong><?php echo $_SESSION['usuario']; ?></strong>
        </div>

        <div class="menu-config">

            <button class="btn-menu" onclick="abrirMenu()" type="button">
                ☰
            </button>

            <div class="dropdown-menu" id="dropdownMenu">

                <button type="button" onclick="trocarTema()">
                    Trocar tema
                </button>

                <a href="logout.php">
                    Sair
                </a>

            </div>

        </div>

    </div>
</div>

<div class="container">

    <div class="titulo">
        <h2>Painel Principal</h2>
        <p>Controle de estoque, localização, recebimento, saída e movimentações do CD.</p>
    </div>

    <div class="indicadores">

        <div class="card-indicador">
            <h3>Produtos cadastrados</h3>
            <div class="numero">
                <?php echo $totalProdutos['total']; ?>
            </div>
        </div>

        <div class="card-indicador">
            <h3>Estoque total</h3>
            <div class="numero">
                <?php echo $totalEstoque['total'] ?? 0; ?>
            </div>
        </div>

        <div class="card-indicador">
            <h3>Entradas</h3>
            <div class="numero entrada">
                <?php echo $entradas['total']; ?>
            </div>
        </div>

        <div class="card-indicador">
            <h3>Saídas</h3>
            <div class="numero saida">
                <?php echo $saidas['total']; ?>
            </div>
        </div>

        <div class="card-indicador">
            <h3>Estoque baixo</h3>
            <div class="numero alerta">
                <?php echo $estoqueBaixo['total']; ?>
            </div>
        </div>

    </div>

    <div class="area-menu">

        <h2>Operações do Sistema</h2>
        <p>Escolha uma funcionalidade para continuar.</p>

        <div class="menu-operacoes">

            <a class="item-menu" href="dashboard.php">Dashboard Completo</a>
            <a class="item-menu" href="recebimento.php">Recebimento de Produtos</a>
            <a class="item-menu" href="saida_produto.php">Saída de Produtos</a>
            <a class="item-menu" href="cadastrar_produto.php">Cadastrar Produto</a>
            <a class="item-menu" href="buscar_produto.php">Buscar Produto</a>
            <a class="item-menu" href="localizar.php">Localizar Produto</a>
            <a class="item-menu" href="procurar_produto.php">Procurar Produto Perdido</a>
            <a class="item-menu" href="movimentacoes.php">Histórico de Movimentações</a>
            <a class="item-menu" href="scanner.php">Scanner</a>

        </div>

    </div>

    <div class="rodape">
        FindWare • Sistema Inteligente de Localização de Produtos
    </div>

</div>

<script>
function abrirMenu() {
    document.getElementById("dropdownMenu").classList.toggle("ativo");
}

document.addEventListener("click", function(event) {
    const menu = document.querySelector(".menu-config");

    if (!menu.contains(event.target)) {
        document.getElementById("dropdownMenu").classList.remove("ativo");
    }
});
</script>

</body>
</html>