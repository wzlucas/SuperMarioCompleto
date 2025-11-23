<?php

require_once(__DIR__ . "/../dao/ProdutoDAO.php");
require_once(__DIR__ . "/../model/Produto.php");
require_once(__DIR__ . "/../service/ProdutoService.php");

class ProdutoController
{

    private ProdutoDAO $produtoDAO;
    private ProdutoService $produtoService;

    public function __construct()
    {
        $this->produtoDAO = new ProdutoDAO();
        $this->produtoService = new ProdutoService();
    }

    public function listar()
    {
        $lista = $this->produtoDAO->listar();
        return $lista;
    }

    public function buscarPorId(int $id)
    {
        $produto = $this->produtoDAO->buscarPorId($id);
        return $produto;
    }

    public function inserir(Produto $produto)
    {
        $erros = $this->produtoService->validarProduto($produto);
        if (count($erros) > 0)
            return $erros;
     
        $erro = $this->produtoDAO->inserir($produto);
        if ($erro) {
            array_push($erros, "Erro ao salvar o produto!");
            if (AMB_DEV)
                array_push($erros, $erro->getMessage());
        }

        return $erros;
    }

    public function alterar(Produto $produto)
    {
        $erros = $this->produtoService->validarProduto($produto);
        if (count($erros) > 0)
            return $erros;

        $erro = $this->produtoDAO->alterar($produto);
        if ($erro) {
            array_push($erros, "Erro ao atualizar o produto!");
            if (AMB_DEV)
                array_push($erros, $erro->getMessage());
        }

        return $erros;
    }

    public function excluirPorId(int $id)
    {
        $erros = array();

        $erro = $this->produtoDAO->excluirPorId($id);
        if ($erro) {
            array_push($erros, "Erro ao excluir o produto!");
            if (AMB_DEV)
                array_push($erros, $erro->getMessage());
        }

        return $erros;
    }
}
