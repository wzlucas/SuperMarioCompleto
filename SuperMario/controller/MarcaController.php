<?php
require_once(__DIR__ . "/../dao/MarcaDAO.php");

class MarcaController
{
    private MarcaDAO $marcaDAO;

    public function __construct()
    {
        $this->marcaDAO = new MarcaDAO();
    }

    public function listar()
    {
        return $this->marcaDAO->listar();
    }

    public function buscarPorCategoria(int $idCategoria)
    {
        return $this->marcaDAO->buscarPorCategoria($idCategoria);
    }
}