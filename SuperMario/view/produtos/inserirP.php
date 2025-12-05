<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once(__DIR__ . "/../../model/Produto.php");
require_once(__DIR__ . "/../../controller/ProdutoController.php");
require_once(__DIR__ . "/../../model/Categoria.php");
require_once(__DIR__ . "/../../model/Distribuidor.php");
require_once(__DIR__ . "/../../model/Marca.php");

$msgErro = "";
$produto = null;


include_once(__DIR__ . "/formP.php");

