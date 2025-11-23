<?php
require_once(__DIR__ . "/../../controller/CategoriaController.php");
require_once(__DIR__ . "/../../controller/DistribuidorController.php");
require_once(__DIR__ . "/../../controller/MarcaController.php");

$categoriaCont = new CategoriaController();
$categorias = $categoriaCont->listar();

$distribuidorCont = new DistribuidorController();
$distribuidores = $distribuidorCont->listar();

$marcaCont = new MarcaController();
$marcas = $marcaCont->listar();

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

            <div class="mb-3">
                <label for="selCategoria" class="form-label">Categoria:</label>
                <select name="categoria" id="selCategoria" class="form-select" onchange="carregarMarcas(this.value)" required>
                    <option value="">----Selecione----</option>
                    <?php foreach ($categorias as $c): ?>
                        <option value="<?= $c->getId() ?>" <?php
                          if ($produto && $produto->getCategoria() && $produto->getCategoria()->getId() == $c->getId())
                              echo "selected";
                          ?>>
                            <?= $c ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="selMarca" class="form-label">Marca:</label>
                <select name="marca" id="selMarca" class="form-select" required>
                    <option value="">----Selecione uma categoria primeiro----</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="selDistribuidor" class="form-label">Distribuidor:</label>
                <select name="distribuidor" id="selDistribuidor" class="form-select">
                    <option value="">----Selecione----</option>
                    <?php foreach ($distribuidores as $d): ?>
                        <option value="<?= $d->getId() ?>" <?php
                          if ($produto && $produto->getDistribuidor() && $produto->getDistribuidor()->getId() == $d->getId())
                              echo "selected";
                          ?>>
                            <?= $d ?>
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

            <input type="hidden" name="id" value="<?= $produto ? $produto->getId() : 0 ?>">

            <div class="mt-2">
                <button type="button" class="btn btn-success" onclick="salvarComAjax()">Gravar</button>
            </div>

        </form>
    </div>

    <div class="col-6">
        <div id="mensagemAjax" class="mt-3"></div>
    </div>
</div>

<div class="mt-2">
    <a href="listarP.php" class="btn btn-outline-primary">Voltar</a>
</div>

<script>
    function carregarMarcas(idCategoria) {
        if (idCategoria === "") {
            document.getElementById('selMarca').innerHTML = '<option value="">----Selecione uma categoria primeiro----</option>';
            return;
        }

        document.getElementById('selMarca').innerHTML = '<option value="">Carregando marcas...</option>';

        const xhr = new XMLHttpRequest();
        xhr.open('GET', `../../controller/ajax/ProdutoAjaxController.php?action=carregarMarcas&id_categoria=${idCategoria}`, true);
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    const resposta = JSON.parse(xhr.responseText);
                    const select = document.getElementById('selMarca');
                    
                    if (resposta.erro) {
                        select.innerHTML = '<option value="">Erro ao carregar</option>';
                    } else {
                        select.innerHTML = '<option value="">----Selecione----</option>';
                        
                        resposta.forEach(function(marca) {
                            const option = document.createElement('option');
                            option.value = marca.id;
                            option.textContent = marca.nome;
                            select.appendChild(option);
                        });
                    }
                    
                } catch (e) {
                    document.getElementById('selMarca').innerHTML = '<option value="">Erro ao carregar</option>';
                }
            }
        };
        
        xhr.send();
    }

    function salvarComAjax() {
        const formData = new FormData(document.getElementById('formProduto'));
        
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../../controller/ajax/ProdutoAjaxController.php?action=salvarProduto', true);
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    const resposta = JSON.parse(xhr.responseText);
                    const mensagemDiv = document.getElementById('mensagemAjax');
                    
                    if (resposta.sucesso) {
                        mensagemDiv.innerHTML = `
                            <div class="alert alert-success">
                                ✅ ${resposta.mensagem}
                            </div>
                        `;
                        
                        setTimeout(() => {
                            window.location.href = 'listarP.php';
                        }, 1500);
                        
                    } else {
                        mensagemDiv.innerHTML = `
                            <div class="alert alert-danger">
                                ❌ ${resposta.erro}
                            </div>
                        `;
                    }
                    
                } catch (e) {
                    console.error('Erro:', e);
                }
            }
        };
        
        xhr.send(formData);
    }

    window.onload = function() {
        const categoriaSelect = document.getElementById('selCategoria');
        if (categoriaSelect.value !== "") {
            carregarMarcas(categoriaSelect.value);
        }
    };
</script>

<?php
include_once(__DIR__ . "/../include/footer.php");
?>