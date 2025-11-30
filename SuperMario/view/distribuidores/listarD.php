<?php
require_once(__DIR__ . "/../../controller/DistribuidorController.php");

$distribuidorCont = new DistribuidorController();
$lista = $distribuidorCont->listar();

include_once(__DIR__ . "/../include/header.php");
?>

<h3>Listagem de Distribuidores</h3>

<div>
    <a href="inserirD.php" class="btn btn-success mt-1 mb-3">Inserir</a>
</div>

<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CNPJ</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Cidade</th>
        <th>Estado</th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach ($lista as $distribuidor): ?>
        <tr>
            <td><?= $distribuidor->getId() ?? 'Não informado'?></td>
            <td><?= $distribuidor->getNome() ?? 'Não informado'?></td>
            <td><?= $distribuidor->getCnpj() ?? 'Não informado' ?></td>
            <td><?= $distribuidor->getEmail() ?? 'Não informado'?></td>
            <td><?= $distribuidor->getTelefone() ?? 'Não informado' ?></td>
            <td><?= $distribuidor->getCidade() ?? 'Não informado' ?></td>
            <td><?= $distribuidor->getEstado() ?? 'Não informado'?></td>
            <td>
                <a href="alterarD.php?id=<?= $distribuidor->getId() ?>">
                    <img src="../../img/btn_editar.png">
                </a>
            </td>
            <td>
                <a href="#" onclick="return excluirComAjax(<?= $distribuidor->getId() ?>, this)">
                    <img src="../../img/btn_excluir.png">
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="mt-2">
    <a href="../../" class="btn btn-outline-primary">Voltar</a>
</div>

<script src="js/excluir.js"></script>

<?php
include_once(__DIR__ . "/../include/footer.php");
?>