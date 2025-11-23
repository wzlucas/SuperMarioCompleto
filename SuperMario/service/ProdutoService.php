<?php

require_once(__DIR__ . "/../model/Produto.php");

class ProdutoService
{

    public function validarProduto(Produto $produto)
    {
        $erros = array();

        if (!$produto->getNome()) {
            array_push($erros, "Informe o nome do produto!");
        }

        if (!$produto->getPreco()) {
            array_push($erros, "Informe o preço do produto!");
        } elseif (!is_numeric($produto->getPreco()) || $produto->getPreco() <= 0) {
            array_push($erros, "O preço deve ser um valor numérico positivo!");
        }

        if (!$produto->getDescricao()) {
            array_push($erros, "Informe a descrição do produto!");
        }

        if (!$produto->getQuantidadeEstoque()) {
            array_push($erros, "Informe a quantidade em estoque do produto!");
        } elseif (!is_numeric($produto->getQuantidadeEstoque()) || $produto->getQuantidadeEstoque() < 0) {
            array_push($erros, "A quantidade em estoque deve ser um número inteiro não negativo!");
        }

        if (!$produto->getCategoria()) {
            array_push($erros, "Informe a categoria do produto!");
        }

        if (!$produto->getDistribuidor()) {
            array_push($erros, "Informe o distribuidor do produto!");
        }

        return $erros;
    }
}
