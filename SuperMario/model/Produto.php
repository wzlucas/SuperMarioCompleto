<?php

require_once(__DIR__ . "/Categoria.php");
require_once(__DIR__ . "/Distribuidor.php");

class Produto
{

    private ?int $id;
    private ?string $nome;
    private ?float $preco;
    private ?string $descricao;
    private ?int $quantidadeEstoque;
    private ?Categoria $categoria;
    private ?Distribuidor $distribuidor;
    private ?Marca $marca;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getPreco(): ?float
    {
        return $this->preco;
    }

    public function setPreco(?float $preco): self
    {
        $this->preco = $preco;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getQuantidadeEstoque(): ?int
    {
        return $this->quantidadeEstoque;
    }

    public function setQuantidadeEstoque(?int $quantidadeEstoque): self
    {
        $this->quantidadeEstoque = $quantidadeEstoque;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getDistribuidor(): ?Distribuidor
    {
        return $this->distribuidor;
    }

    public function setDistribuidor(?Distribuidor $distribuidor): self
    {
        $this->distribuidor = $distribuidor;

        return $this;
    }

     public function getMarca(): ?Marca
    {
        return $this->marca;
    }

    public function setMarca(?Marca $marca): self
    {
        $this->marca = $marca;
        return $this;
    }
}
