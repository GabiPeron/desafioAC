CREATE DATABASE desafioac;

USE desafioac;

CREATE TABLE produtos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    estoque INTEGER NOT NULL,
    codigo INTEGER NOT NULL,
    valor FLOAT NOT NULL,
    deleted BOOLEAN NOT NULL
)