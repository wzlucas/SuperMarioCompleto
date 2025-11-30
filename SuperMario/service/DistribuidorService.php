<?php

require_once(__DIR__ . "/../model/Distribuidor.php");

class DistribuidorService
{

    public function validarDistribuidor(Distribuidor $distribuidor)
    {
        $erros = array();

        if (!$distribuidor->getNome()) {
            array_push($erros, "Informe o nome do distribuidor!");
        }

        if (!$distribuidor->getCnpj()) {
            array_push($erros, "Informe o CNPJ do distribuidor!");
        }

        if (!$distribuidor->getEmail()) {
            array_push($erros, "Informe o email do distribuidor!");
        }

        if (!$distribuidor->getTelefone()) {
            array_push($erros, "Informe o telefone do distribuidor!");
        }

        if (!$distribuidor->getEndereco()) {
            array_push($erros, "Informe o endereço do distribuidor!");
        }

        if (!$distribuidor->getCidade()) {
            array_push($erros, "Informe a cidade do distribuidor!");
        }

        if (!$distribuidor->getEstado()) {
            array_push($erros, "Informe o estado do distribuidor!");
        }

        if (!$distribuidor->getCep()) {
            array_push($erros, "Informe o CEP do distribuidor!");
        }

        return $erros;
    }
}