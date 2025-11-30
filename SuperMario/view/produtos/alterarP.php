<?php
require_once(__DIR__ . "/../../model/Produto.php");
require_once(__DIR__ . "/../../controller/ProdutoController.php");
require_once(__DIR__ . "/../../model/Categoria.php");
require_once(__DIR__ . "/../../model/Distribuidor.php");
require_once(__DIR__ . "/../../model/Marca.php");

$msgErro = "";
$produto = null;

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $produtoCont = new ProdutoController();
    $produto = $produtoCont->buscarPorId($id);

    if (!$produto) {
        echo "ID do produto é inválido!<br>";
        echo "<a href='listarP.php'>Voltar</a>";
        exit;
    }
}

include_once(__DIR__ . "/formP.php");