<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento - Super Mario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/styleIndex.css">
</head>
<body>

    <h1 class="mario-title">SUPER MARIO</h1>

    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-3">
                <div class="card text-center">
                    <img class="card-image-top mx-auto" src="img/produto.webp"
                        style="max-width: 200px; height: auto;" />

                    <div class="card-body">
                        <h5 class="card-title">Produtos</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="view/produtos/listarP.php" class="card-link">
                                Listagem de Produtos</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-3">
                <div class="card text-center">
                    <img class="card-image-top mx-auto" src="img/Distribuidor.png"
                        style="max-width: 200px; height: auto;" />

                    <div class="card-body">
                        <h5 class="card-title">Distribuidores</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="view/distribuidores/listarD.php" class="card-link">
                                Listagem de Distribuidores</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center p-4">
        © 2025 Copyright:
        <a href="https://github.com/GustavoGussolli/SuperMario_Completo" target="blank">SUPERMARIO</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>
</html>