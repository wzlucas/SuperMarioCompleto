const selCategoria = document.querySelector("#selCategoria");
const selMarca = document.querySelector("#selMarca");
const selDistribuidor = document.querySelector("#selDistribuidor");
const divErro = document.getElementById("divMsgErro");

function carregarMarcas(idCategoria) {
    if (idCategoria === "" || idCategoria === "0") {
        selMarca.innerHTML = '<option value="">----Selecione uma categoria primeiro----</option>';
        return;
    }

    selMarca.innerHTML = '<option value="">Carregando marcas...</option>';

    const url = `../../api/marcas_por_categoria.php?idCategoria=${idCategoria}`;

    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", url);
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            const marcas = JSON.parse(xhttp.responseText);
            selMarca.innerHTML = '<option value="">---Selecione---</option>';
            marcas.forEach(marca => adicionarOptionMarca(marca));
        }
    };
    xhttp.send();
}

function adicionarOptionMarca(marca) {
    const option = document.createElement("option");
    option.value = marca.id ?? marca.idMarca;   
    option.innerHTML = marca.nome;

    const idSelecionado = selMarca.getAttribute("idSelecionado");
    if (idSelecionado == marca.id)
        option.selected = true;

    selMarca.appendChild(option);
}


function salvarProdutoAjax() {
     
   // Coletar dados do formulário
    const nome = document.querySelector("#txtNome").value;
    const preco = document.querySelector("#txtPreco").value;
    const descricao = document.querySelector("#txtDescricao").value;
    const quantidade = document.querySelector("#txtQuantidadeEstoque").value;
    const categoria = selCategoria.value;
    const marca = selMarca.value;
    const distribuidor = selDistribuidor.value;
    const id = document.querySelector("input[name='id']").value;

    // Validação dos campos
    divErro.innerHTML = "";
    divErro.style.display = "none";

    if (!nome.trim()) {
        divErro.innerHTML = "Informe o nome do produto!";
        divErro.style.display = "block";
        return;
    }

    if (!preco || preco <= 0) {
        divErro.innerHTML = "Informe um preço válido!";
        divErro.style.display = "block";
        return;
    }

    if (!quantidade || quantidade < 0) {
        divErro.innerHTML = "Informe uma quantidade válida!";
        divErro.style.display = "block";
        return;
    }

    if (!categoria || categoria === "0") {
        divErro.innerHTML = "Selecione uma categoria!";
        divErro.style.display = "block";
        return;
    }

    if (!marca || marca === "") {
        divErro.innerHTML = "Selecione uma marca!";
        divErro.style.display = "block";
        return;
    }

    // Preparar dados para envio
    const dados = new FormData();
    dados.append("nome", nome);
    dados.append("preco", preco);
    dados.append("descricao", descricao);
    dados.append("quantidade_estoque", quantidade);
    dados.append("categoria", categoria);
    dados.append("marca", marca);
    dados.append("distribuidor", distribuidor);
    dados.append("id", id);

    console.log("Enviando dados:", {
        nome, preco, descricao, quantidade, categoria, marca, distribuidor, id
    });

    // Fazer a requisição AJAX
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../../api/produtos_salvar.php");
    
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            const resposta = xhttp.responseText;
            
            if (resposta.trim() === "") {
                window.location.href = "listarP.php";
            } else {
                
                divErro.innerHTML = resposta;
                divErro.style.display = "block";
            }
        }
    };
    
xhttp.send(dados);
}

