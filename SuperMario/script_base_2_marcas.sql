-- Tabela para Marcas
CREATE TABLE marcas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL UNIQUE,
    id_categoria INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id)
);

-- Inserir marcas relacionadas às categorias existentes
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

-- Adicionar coluna de marca na tabela produtos (se não existir)
ALTER TABLE produtos ADD COLUMN IF NOT EXISTS id_marca INT;
ALTER TABLE produtos ADD FOREIGN KEY (id_marca) REFERENCES marcas(id);