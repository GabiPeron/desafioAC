CREATE DATABASE desafioac;

USE desafioac;

CREATE TABLE produtos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    estoque INTEGER NOT NULL,
    codigo INTEGER NOT NULL,
    valor FLOAT NOT NULL,
    deleted BOOLEAN NOT NULL,
    ultima_venda TIMESTAMP
)

CREATE TABLE vendas(
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INTEGER NOT NULL,
    quantidade INTEGER NOT NULL,
    valor_unitario INTEGER NOT NULL,
    valor_total FLOAT NOT NULL,
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
)