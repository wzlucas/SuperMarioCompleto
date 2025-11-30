<?php

require_once(__DIR__ . "/../dao/DistribuidorDAO.php");
require_once(__DIR__ . "/../model/Distribuidor.php");
require_once(__DIR__ . "/../service/DistribuidorService.php");

class DistribuidorController
{

    private DistribuidorDAO $distribuidorDAO;
    private DistribuidorService $distribuidorService;

    public function __construct()
    {
        $this->distribuidorDAO = new DistribuidorDAO;
        $this->distribuidorService = new DistribuidorService();
    }

    public function listar()
    {
        return $this->distribuidorDAO->listar();
    }

    public function buscarPorId(int $id)
    {
        $distribuidor = $this->distribuidorDAO->buscarPorId($id);
        return $distribuidor;
    }

    public function inserir(Distribuidor $distribuidor)
    {
        $erros = $this->distribuidorService->validarDistribuidor($distribuidor);
        if (count($erros) > 0)
            return $erros;
    
        $erro = $this->distribuidorDAO->inserir($distribuidor);
        if ($erro) {
            array_push($erros, "Erro ao salvar o distribuidor!");
            if (AMB_DEV)
                array_push($erros, $erro->getMessage());
        }

        return $erros;
    }

    public function alterar(Distribuidor $distribuidor)
    {
        $erros = $this->distribuidorService->validarDistribuidor($distribuidor);
        if (count($erros) > 0)
            return $erros;

        $erro = $this->distribuidorDAO->alterar($distribuidor);
        if ($erro) {
            array_push($erros, "Erro ao atualizar o distribuidor!");
            if (AMB_DEV)
                array_push($erros, $erro->getMessage());
        }

        return $erros;
    }

    public function excluirPorId(int $id)
    {
        $erros = array();

        $erro = $this->distribuidorDAO->excluirPorId($id);
        if ($erro) {
            array_push($erros, "Erro ao excluir o distribuidor!");
            if (AMB_DEV)
                array_push($erros, $erro->getMessage());
        }

        return $erros;
    }
}