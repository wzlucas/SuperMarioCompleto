<?php


require_once(__DIR__ . "/../../controller/CategoriaController.php");
require_once(__DIR__ . "/../../controller/DistribuidorController.php");
require_once(__DIR__ . "/../../controller/MarcaController.php");

$categoriaCont = new CategoriaController();
$categorias = $categoriaCont->listar();

$distribuidorCont = new DistribuidorController();
$distribuidores = $distribuidorCont->listar();

$idCategoria = isset($_GET['idCategoria']) ? (int) $_GET['idCategoria'] : 0;
$marcaCont = new MarcaController();
$marcas = $marcaCont->listarPorCategoria($idCategoria);

include_once(__DIR__ . "/../include/header.php");
?>

<h3><?= $produto && $produto->getId() > 0 ? 'Alterar' : 'Inserir' ?> produto</h3>

<div class="row">
    <div class="col-6">
        <form id="formProduto">

            <div class="mb-3">
                <label for="txtNome" class="form-label">Nome:</label>
                <input type="text" id="txtNome" name="nome" placeholder="Informe o nome" class="form-control"
                    value="<?= $produto ? $produto->getNome() : '' ?>" required>
            </div>

            <div class="mb-3">
                <label for="txtPreco" class="form-label">Preço:</label>
                <input type="number" id="txtPreco" name="preco" placeholder="Informe o preço" class="form-control"
                    value="<?= $produto ? $produto->getPreco() : '' ?>" step="0.01" required>
            </div>

              <div>
                <label for="selCategoria" class="form-label">Categoria:</label>
               <select id="selCategoria" name="categoria" class="form-control" onchange="carregarMarcas(this.value)">
                    <option value="0">---Selecione---</option>
                    <?php foreach($categorias as $c): ?>
                        <option value="<?= $c->getId() ?>"
                            <?php echo (($idCategoria == $c->getId()) ? 'selected' : ''); ?>
                        >
                        
                        <?= $c ?></option>
                    <?php endforeach; ?>
                </select>        
            </div>

            <div>
                <label for="selMarca" class="form-label">Marca:</label>
                <select id="selMarca" name="marca" class="form-control" 
                    idSelecionado="<?php echo ($produto && $produto->getMarca() ? $produto->getMarca()->getId() : '0'); ?>" >
                    <option value="">----Selecione uma categoria primeiro----</option>
                </select>        
            </div>

            <div class="mb-3">
                <label for="selDistribuidor" class="form-label">Distribuidor:</label>
                <select name="distribuidor" id="selDistribuidor" class="form-select" required>
                    <option value="">----Selecione----</option>
                         <?php foreach ($distribuidores as $d): ?>
                    <option value="<?= $d->getId() ?>">
                        <?= $d->getNome() ?> 
                    </option>
            <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="txtDescricao" class="form-label">Descrição:</label>
                <textarea id="txtDescricao" name="descricao" placeholder="Informe a descrição" class="form-control"
                    rows="3"><?= $produto ? $produto->getDescricao() : '' ?></textarea>
            </div>

            <div class="mb-3">
                <label for="txtQuantidadeEstoque" class="form-label">Quantidade em Estoque:</label>
                <input type="number" id="txtQuantidadeEstoque" name="quantidade_estoque"
                    placeholder="Informe a quantidade em estoque" class="form-control"
                    value="<?= $produto ? $produto->getQuantidadeEstoque() : '' ?>" required>
            </div>

                <input type="hidden" name="id" value="<?php echo ($produto ? $produto->getId() : 0); ?>" />
            
            <button type="button" class="btn btn-success"
                onclick="salvarProdutoAjax()" >
                <?php echo ($produto && $produto->getId() > 0) ? 'Atualizar' : 'Gravar'; ?>
            </button>
        </form>
    </div>

    <div class="col-6">
        <?php if($msgErro): ?>
            <div class="alert alert-danger">
                <?php echo $msgErro; ?>
            </div>
        <?php endif; ?>
        
        <div id="divMsgErro" class="alert alert-danger" style="display: none;">
            
        </div>
    </div> 
</div>

<div class="mt-2">
    <a href="listarP.php" class="btn btn-outline-primary">Voltar</a>
</div>

<script src="js/produtos.js"></script>


<?php
include_once(__DIR__ . "/../include/footer.php");
?>