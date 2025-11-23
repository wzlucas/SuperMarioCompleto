<?php

require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Produto.php");
require_once(__DIR__ . "/../model/Categoria.php");
require_once(__DIR__ . "/../model/Distribuidor.php");

class ProdutoDAO
{

    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Connection::getConnection();
    }

    public function listar()
    {
        $sql = "SELECT p.*, 
                    c.nome nome_categoria, 
                    d.nome nome_distribuidor 
                FROM produtos p
                    JOIN categorias c ON (c.id = p.id_categoria)
                    JOIN distribuidores d ON (d.id = p.id_distribuidor)
                ORDER BY p.nome";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->map($result);
    }

    public function buscarPorId(int $id)
    {
        $sql = "SELECT p.*, 
                    c.nome nome_categoria, 
                    d.nome nome_distribuidor 
                FROM produtos p
                    JOIN categorias c ON (c.id = p.id_categoria)
                    JOIN distribuidores d ON (d.id = p.id_distribuidor)
                WHERE p.id = ?";
        $stm = $this->conexao->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $produtos = $this->map($result);

        if (count($produtos) > 0)
            return $produtos[0];
        else
            return NULL;
    }

    public function inserir(Produto $produto)
    {
        try {
            $sql = "INSERT INTO produtos (nome, preco, descricao, quantidade_estoque, id_categoria, id_distribuidor)
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([
                $produto->getNome(),
                $produto->getPreco(),
                $produto->getDescricao(),
                $produto->getQuantidadeEstoque(),
                $produto->getCategoria()->getId(),
                $produto->getDistribuidor()->getId()
            ]);
            return NULL;
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function alterar(Produto $produto)
    {
        try {
            $sql = "UPDATE produtos SET nome = ?, preco = ?,
                        descricao = ?, quantidade_estoque = ?, 
                        id_categoria = ?, id_distribuidor = ?
                    WHERE id = ?";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([
                $produto->getNome(),
                $produto->getPreco(),
                $produto->getDescricao(),
                $produto->getQuantidadeEstoque(),
                $produto->getCategoria()->getId(),
                $produto->getDistribuidor()->getId(),
                $produto->getId()
            ]);
            return NULL;
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function excluirPorId(int $id)
    {
        try {
            $sql = "DELETE FROM produtos 
                    WHERE id = :id";
            $stm = $this->conexao->prepare($sql);
            $stm->bindValue("id", $id);
            $stm->execute();
            return NULL;
        } catch (PDOException $e) {
            return $e;
        }
    }

    private function map(array $result)
    {
        $produtos = array();
        foreach ($result as $r) {
            $produto = new Produto();
            $produto->setId($r["id"]);
            $produto->setNome($r['nome']);
            $produto->setPreco($r["preco"]);
            $produto->setDescricao($r['descricao']);
            $produto->setQuantidadeEstoque($r['quantidade_estoque']);

            $categoria = new Categoria();
            $categoria->setId($r["id_categoria"]);
            $categoria->setNome($r["nome_categoria"]);
            $produto->setCategoria($categoria);

            $distribuidor = new Distribuidor();
            $distribuidor->setId($r["id_distribuidor"]);
            $distribuidor->setNome($r["nome_distribuidor"]);
            $produto->setDistribuidor($distribuidor);

            array_push($produtos, $produto);
        }
        return $produtos;
    }

}
