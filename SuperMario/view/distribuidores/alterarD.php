<?php

require_once(__DIR__ . "/../../model/Distribuidor.php");
require_once(__DIR__ . "/../../controller/DistribuidorController.php");

$msgErro = "";
$distribuidor = null;

if (isset($_POST['nome'])) {
    $id = $_POST["id"];
    $nome = trim($_POST['nome']) ? trim($_POST['nome']) : NULL;
    $cnpj = trim($_POST['cnpj']) ? trim($_POST['cnpj']) : NULL;
    $email = trim($_POST['email']) ? trim($_POST['email']) : NULL;
    $telefone = trim($_POST['telefone']) ? trim($_POST['telefone']) : NULL;
    $endereco = trim($_POST['endereco']) ? trim($_POST['endereco']) : NULL;
    $cidade = trim($_POST['cidade']) ? trim($_POST['cidade']) : NULL;
    $estado = trim($_POST['estado']) ? trim($_POST['estado']) : NULL;
    $cep = trim($_POST['cep']) ? trim($_POST['cep']) : NULL;

    $distribuidor = new Distribuidor();
    $distribuidor->setId($id);
    $distribuidor->setNome($nome);
    $distribuidor->setCnpj($cnpj);
    $distribuidor->setEmail($email);
    $distribuidor->setTelefone($telefone);
    $distribuidor->setEndereco($endereco);
    $distribuidor->setCidade($cidade);
    $distribuidor->setEstado($estado);
    $distribuidor->setCep($cep);

    $distribuidorCont = new DistribuidorController();
    $erros = $distribuidorCont->alterar($distribuidor);

    if (!$erros) {
        header("location: listarD.php");
    } else {
        $msgErro = implode("<br>", $erros);
    }

} else {
    $id = 0;
    if (isset($_GET["id"]))
        $id = $_GET["id"];

    $distribuidorCont = new DistribuidorController();
    $distribuidor = $distribuidorCont->buscarPorId($id);

    if (!$distribuidor) {
        echo "ID do distribuidor é inválido!<br>";
        echo "<a href='listarD.php'>Voltar</a>";
        exit;
    }
}

include_once(__DIR__ . "/formD.php");