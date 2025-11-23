<?php
require_once(__DIR__ . "/../../dao/ProdutoDAO.php");
require_once(__DIR__ . "/../../dao/MarcaDAO.php");
require_once(__DIR__ . "/../../model/Produto.php");
require_once(__DIR__ . "/../../model/Categoria.php");
require_once(__DIR__ . "/../../model/Distribuidor.php");
require_once(__DIR__ . "/../../model/Marca.php");

header('Content-Type: application/json');

class ProdutoAjaxController
{
    private ProdutoDAO $produtoDAO;
    private MarcaDAO $marcaDAO;

    public function __construct()
    {
        $this->produtoDAO = new ProdutoDAO();
        $this->marcaDAO = new MarcaDAO();
    }

    public function carregarMarcas()
    {
        try {
            $idCategoria = $_GET['id_categoria'] ?? 0;
            
            if ($idCategoria <= 0) {
                throw new Exception("ID da categoria inválido");
            }
            $marcas = $this->marcaDAO->buscarPorCategoria($idCategoria);
            
            $marcasArray = [];
            foreach ($marcas as $marca) {
                $marcasArray[] = [
                    'id' => $marca->getId(),
                    'nome' => $marca->getNome()
                ];
            }
            
            echo json_encode($marcasArray);
            
        } catch (Exception $e) {
            echo json_encode([
                'error' => 'Erro ao carregar marcas: ' . $e->getMessage()
            ]);
        }
    }

    public function salvarProduto()
    {
        try {
            $id = $_POST['id'] ?? 0;
            $nome = $_POST['nome'] ?? '';
            $preco = $_POST['preco'] ?? 0;
            $descricao = $_POST['descricao'] ?? '';
            $quantidadeEstoque = $_POST['quantidade_estoque'] ?? 0;
            $idCategoria = $_POST['categoria'] ?? 0;
            $idDistribuidor = $_POST['distribuidor'] ?? 0;
            $idMarca = $_POST['marca'] ?? 0;

            if (empty($nome)) {
                throw new Exception("Nome é obrigatório");
            }
            if ($idCategoria <= 0) {
                throw new Exception("Selecione uma categoria");
            }
            if ($idMarca <= 0) {
                throw new Exception("Selecione uma marca");
            }

            $produto = new Produto();
            $produto->setId($id);
            $produto->setNome($nome);
            $produto->setPreco(floatval($preco));
            $produto->setDescricao($descricao);
            $produto->setQuantidadeEstoque(intval($quantidadeEstoque));

            $categoria = new Categoria();
            $categoria->setId($idCategoria);
            $produto->setCategoria($categoria);

            $marca = new Marca();
            $marca->setId($idMarca);
            $produto->setMarca($marca);

            if ($idDistribuidor > 0) {
                $distribuidor = new Distribuidor();
                $distribuidor->setId($idDistribuidor);
                $produto->setDistribuidor($distribuidor);
            }

            if ($id > 0) {
                $erro = $this->produtoDAO->alterar($produto);
                $mensagem = "Produto alterado com sucesso!";
            } else {
                $erro = $this->produtoDAO->inserir($produto);
                $mensagem = "Produto cadastrado com sucesso!";
            }
            if ($erro) {
                throw new Exception("Erro ao salvar no banco de dados");
            }

            echo json_encode([
                'sucesso' => true,
                'mensagem' => $mensagem
            ]);

        } catch (Exception $e) {
            echo json_encode([
                'sucesso' => false,
                'erro' => $e->getMessage()
            ]);
        }
    }
}

$action = $_GET['action'] ?? '';
$controller = new ProdutoAjaxController();

if ($action === 'carregarMarcas') {
    $controller->carregarMarcas();
} elseif ($action === 'salvarProduto') {
    $controller->salvarProduto();
}