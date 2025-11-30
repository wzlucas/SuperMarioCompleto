<?php 

require_once(__DIR__ . "/../model/Produto.php");
require_once(__DIR__ . "/../model/Marca.php");
require_once(__DIR__ . "/../model/Categoria.php");
require_once(__DIR__ . "/../model/Distribuidor.php");
require_once(__DIR__ . "/../service/ProdutoService.php");
require_once(__DIR__ . "/../controller/ProdutoController.php");

$id = isset($_POST['id']) ? $_POST['id'] : 0;
$nome = $_POST['nome'] ?? '';
$preco = $_POST['preco'] ?? 0;
$descricao = $_POST['descricao'] ?? '';
$quantidadeEstoque = $_POST['quantidade_estoque'] ?? 0;
$idCategoria = $_POST['categoria'] ?? 0;
$idDistribuidor = $_POST['distribuidor'] ?? 0;
$idMarca = $_POST['marca'] ?? 0;

$produto = new Produto();
$produto->setId($id);
$produto->setNome($nome);
$produto->setPreco($preco);
$produto->setDescricao($descricao);
$produto->setQuantidadeEstoque($quantidadeEstoque);
$produto->setMarca(new Marca($idMarca));
$produto->setCategoria(new Categoria($idCategoria));


// Garantir que o distribuidor tenha um ID válido
if ($idDistribuidor > 0) {
    $produto->setDistribuidor(new Distribuidor($idDistribuidor));
    error_log("Distribuidor criado com ID: " . $idDistribuidor);
} else {
    
    echo "Erro: Selecione um distribuidor!";
    exit;
}

$service = new ProdutoService();
$erros = $service->validarProduto($produto);

if (!empty($erros)) {
    echo implode("<br>", $erros);
    exit;
}

$produtoCont = new ProdutoController();
$erros = $produtoCont->salvar($produto);

if (!empty($erros)) {
    echo implode("<br>", $erros);
} else {
    // RETORNA VAZIO para indicar sucesso
    echo "";
}