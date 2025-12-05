<?php

require_once(__DIR__ . "/../dao/CategoriaDAO.php");

class CategoriaController
{

    private CategoriaDAO $categoriaDAO;

    public function __construct()
    {
        $this->categoriaDAO = new CategoriaDAO;
    }

    public function listar()
    {
        return $this->categoriaDAO->listar();
    }

}
