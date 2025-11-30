<?php
include_once(__DIR__ . "/../include/header.php");
?>

<h3><?= $distribuidor && $distribuidor->getId() > 0 ? 'Alterar' : 'Inserir' ?> distribuidor</h3>

<div class="row">
    <div class="col-6">
        <form method="POST" action="">

            <div>
                <label for="txtNome" class="form-label">Nome:</label>
                <input type="text" id="txtNome" name="nome" placeholder="Informe o nome" class="form-control"
                    value="<?= $distribuidor ? $distribuidor->getNome() : '' ?>">
            </div>

            <div>
                <label for="txtCnpj" class="form-label">CNPJ:</label>
                <input type="text" id="txtCnpj" name="cnpj" placeholder="Informe o CNPJ" class="form-control"
                    value="<?= $distribuidor ? $distribuidor->getCnpj() : '' ?>">
            </div>

            <div>
                <label for="txtEmail" class="form-label">Email:</label>
                <input type="email" id="txtEmail" name="email" placeholder="Informe o email" class="form-control"
                    value="<?= $distribuidor ? $distribuidor->getEmail() : '' ?>">
            </div>

            <div>
                <label for="txtTelefone" class="form-label">Telefone:</label>
                <input type="text" id="txtTelefone" name="telefone" placeholder="Informe o telefone" class="form-control"
                    value="<?= $distribuidor ? $distribuidor->getTelefone() : '' ?>">
            </div>

            <div>
                <label for="txtEndereco" class="form-label">Endereço:</label>
                <input type="text" id="txtEndereco" name="endereco" placeholder="Informe o endereço" class="form-control"
                    value="<?= $distribuidor ? $distribuidor->getEndereco() : '' ?>">
            </div>

            <div>
                <label for="txtCidade" class="form-label">Cidade:</label>
                <input type="text" id="txtCidade" name="cidade" placeholder="Informe a cidade" class="form-control"
                    value="<?= $distribuidor ? $distribuidor->getCidade() : '' ?>">
            </div>

            <div>
                <label for="txtEstado" class="form-label">Estado:</label>
                <input type="text" id="txtEstado" name="estado" placeholder="Informe o estado (ex: SP)" class="form-control"
                    value="<?= $distribuidor ? $distribuidor->getEstado() : '' ?>" maxlength="2">
            </div>

            <div>
                <label for="txtCep" class="form-label">CEP:</label>
                <input type="text" id="txtCep" name="cep" placeholder="Informe o CEP" class="form-control"
                    value="<?= $distribuidor ? $distribuidor->getCep() : '' ?>">
            </div>

            <input type="hidden" name="id" value="<?= $distribuidor ? $distribuidor->getId() : 0 ?>">

            <div class="mt-2">
                <button type="submit" class="btn btn-success">Gravar</button>
            </div>

        </form>
    </div>

    <div class="col-6">
        <?php if ($msgErro): ?>
            <div class="alert alert-danger">
                <?= $msgErro ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="mt-2">
    <a href="listarD.php" class="btn btn-outline-primary">Voltar</a>
</div>

<?php
include_once(__DIR__ . "/../include/footer.php");
?>
