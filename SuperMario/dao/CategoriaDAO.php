<?php

require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Categoria.php");

class CategoriaDAO
{

    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Connection::getConnection();
    }

    public function listar()
    {
        $sql = "SELECT * FROM categorias ORDER BY nome";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $resultado = $stm->fetchAll();

        $categorias = $this->map($resultado);
        return $categorias;
    }

    private function map($resultado)
    {
        $categorias = array();
        foreach ($resultado as $r) {
            $categoria = new Categoria();
            $categoria->setId($r['id']);
            $categoria->setNome($r['nome']);

            array_push($categorias, $categoria);
        }

        return $categorias;
    }

}
