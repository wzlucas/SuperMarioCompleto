<?php
require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Marca.php");
require_once(__DIR__ . "/../model/Categoria.php");

class MarcaDAO
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Connection::getConnection();
    }

    public function listar()
    {
        $sql = "SELECT m.*, c.nome as nome_categoria 
                FROM marcas m 
                JOIN categorias c ON (c.id = m.id_categoria) 
                ORDER BY m.nome";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $resultado = $stm->fetchAll();

        return $this->map($resultado);
    }

    public function buscarPorCategoria(int $idCategoria)
    {
        $sql = "SELECT m.*, c.nome as nome_categoria 
                FROM marcas m 
                JOIN categorias c ON (c.id = m.id_categoria) 
                WHERE m.id_categoria = ? 
                ORDER BY m.nome";
        $stm = $this->conexao->prepare($sql);
        $stm->execute([$idCategoria]);
        $resultado = $stm->fetchAll();

        return $this->map($resultado);
    }

    private function map($resultado)
    {
        $marcas = array();
        foreach ($resultado as $r) {
            $marca = new Marca();
            $marca->setId($r['id']);
            $marca->setNome($r['nome']);

            $categoria = new Categoria();
            $categoria->setId($r['id_categoria']);
            $categoria->setNome($r['nome_categoria']);
            $marca->setCategoria($categoria);

            array_push($marcas, $marca);
        }

        return $marcas;
    }
}