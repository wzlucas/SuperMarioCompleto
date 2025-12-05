<?php

require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Distribuidor.php");

class DistribuidorDAO
{

    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Connection::getConnection();
    }

    public function listar()
    {
        $sql = "SELECT * FROM distribuidores ORDER BY nome";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $resultado = $stm->fetchAll();

        $distribuidores = $this->map($resultado);
        return $distribuidores;
    }

    public function buscarPorId(int $id)
    {
        $sql = "SELECT * FROM distribuidores WHERE id = ?";
        $stm = $this->conexao->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $distribuidores = $this->map($result);

        if (count($distribuidores) > 0)
            return $distribuidores[0];
        else
            return NULL;
    }

    public function inserir(Distribuidor $distribuidor)
    {
        try {
            $sql = "INSERT INTO distribuidores (nome, cnpj, email, telefone, endereco, cidade, estado, cep) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([
                $distribuidor->getNome(),
                $distribuidor->getCnpj(),
                $distribuidor->getEmail(),
                $distribuidor->getTelefone(),
                $distribuidor->getEndereco(),
                $distribuidor->getCidade(),
                $distribuidor->getEstado(),
                $distribuidor->getCep()
            ]);
            return NULL;
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function alterar(Distribuidor $distribuidor)
    {
        try {
            $sql = "UPDATE distribuidores SET 
                    nome = ?, cnpj = ?, email = ?, telefone = ?, 
                    endereco = ?, cidade = ?, estado = ?, cep = ? 
                    WHERE id = ?";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([
                $distribuidor->getNome(),
                $distribuidor->getCnpj(),
                $distribuidor->getEmail(),
                $distribuidor->getTelefone(),
                $distribuidor->getEndereco(),
                $distribuidor->getCidade(),
                $distribuidor->getEstado(),
                $distribuidor->getCep(),
                $distribuidor->getId()
            ]);
            return NULL;
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function excluirPorId(int $id)
    {
        try {
            $sql = "DELETE FROM distribuidores WHERE id = :id";
            $stm = $this->conexao->prepare($sql);
            $stm->bindValue("id", $id);
            $stm->execute();
            return NULL;
        } catch (PDOException $e) {
            return $e;
        }
    }

    private function map($resultado)
    {
        $distribuidores = array();
        foreach ($resultado as $r) {
            $distribuidor = new Distribuidor();
            $distribuidor->setId($r['id']);
            $distribuidor->setNome($r['nome']);
            $distribuidor->setCnpj($r['cnpj']);
            $distribuidor->setEmail($r['email']);
            $distribuidor->setTelefone($r['telefone']);
            $distribuidor->setEndereco($r['endereco']);
            $distribuidor->setCidade($r['cidade']);
            $distribuidor->setEstado($r['estado']);
            $distribuidor->setCep($r['cep']);

            array_push($distribuidores, $distribuidor);
        }

        return $distribuidores;
    }

}