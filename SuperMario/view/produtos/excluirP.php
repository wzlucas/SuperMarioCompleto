<?php

require_once(__DIR__ . "/../../controller/ProdutoController.php");

$id = 0;
if (isset($_GET['id']))
   $id = $_GET['id'];

$produtoCont = new ProdutoController();
$produto = $produtoCont->buscarPorId($id);
if ($produto) {
   $erros = $produtoCont->excluirPorId($produto->getId());

   if ($erros) {
      $msgErros = implode("<br>", $erros);
      echo $msgErros;
   } else {
      header("location: listarP.php");
      exit;
   }

} else {
   echo "Produto não encontrado!<br>";
   echo "<a href='listarP.php'>Voltar</a>";
}