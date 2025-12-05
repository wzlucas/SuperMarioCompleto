<?php
require_once(__DIR__ . "/Categoria.php");

class Marca
{
    private ?int $id = null;
    private ?string $nome;
    private ?Categoria $categoria;

    public function __construct($id = null, $nome = null) {
        $this->id = $id;
        $this->nome = $nome;
    }

    public function __toString()
    {
        return $this->nome;
    }

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

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;
        return $this;
    }
}