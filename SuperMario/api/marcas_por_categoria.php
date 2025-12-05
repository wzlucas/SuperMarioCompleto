<?php

require_once(__DIR__ . "/../controller/MarcaController.php");

header("Content-Type: application/json");

$idCategoria = isset($_GET['idCategoria']) ? (int) $_GET['idCategoria'] : 0;

$marcaCont = new MarcaController();
$marcas = $marcaCont->listarPorCategoria($idCategoria);

$dados = [];
foreach ($marcas as $m) {
    $dados[] = [
        "id" => $m->getId(),
        "nome" => $m->getNome()
    ];
}

echo json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);