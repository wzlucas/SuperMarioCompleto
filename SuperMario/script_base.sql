CREATE TABLE categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL UNIQUE
);

INSERT INTO categorias (nome) VALUES
('Eletrônicos'),
('Alimentos'),
('Roupas'),
('Livros'),
('Brinquedos');

CREATE TABLE distribuidores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL UNIQUE,
    cnpj INT(14) UNIQUE NOT NULL,
    email VARCHAR(255),
    telefone CHAR(15),
    endereco VARCHAR(255),
    cidade VARCHAR(100),
    estado CHAR(2),
    cep INT(8) NOT NULL
);

CREATE TABLE produtos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    descricao TEXT,
    quantidade_estoque INT NOT NULL,
    id_categoria INT NOT NULL,
    id_distribuidor INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id),
    FOREIGN KEY (id_distribuidor) REFERENCES distribuidores(id)
);

CREATE TABLE marcas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL UNIQUE,
    id_categoria INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id)
);

INSERT INTO marcas (nome, id_categoria) VALUES
-- Eletrônicos (categoria 1)
('Sony', 1),
('Samsung', 1),
('LG', 1),
('Apple', 1),
-- Alimentos (categoria 2)
('Nestlé', 2),
('Coca-Cola', 2),
('Sadia', 2),
-- Roupas (categoria 3)
('Nike', 3),
('Adidas', 3),
('Renner', 3),
-- Livros (categoria 4)
('Editora A', 4),
('Editora B', 4),
('Editora C', 4),
-- Brinquedos (categoria 5)
('Estrela', 5),
('Hasbro', 5),
('Mattel', 5);

ALTER TABLE produtos ADD COLUMN IF NOT EXISTS id_marca INT;
ALTER TABLE produtos ADD FOREIGN KEY (id_marca) REFERENCES marcas(id);