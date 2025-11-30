<?php
require_once(__DIR__ . "/../dao/MarcaDAO.php");

class MarcaController
{
  public function listarPorCategoria(int $idCategoria) {
        $marcaDAO = new MarcaDAO();

        return $marcaDAO->listByCategoria($idCategoria);
    }

}