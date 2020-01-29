CREATE DATABASE Notavel;
CREATE USER 'Notavel'@'localhost' IDENTIFIED BY 'admin';
GRANT ALL ON Notavel.* TO 'Notavel'@'localhost';
FLUSH PRIVILEGES;

USE Notavel;

CREATE TABLE usuarios(
	usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(45) NOT NULL,
    email VARCHAR(60) NOT NULL,
    usuario VARCHAR(20) NOT NULL,
    senha VARCHAR(120)
);

CREATE TABLE anotacoes(
	usuario_id INT,
    nota_id INT AUTO_INCREMENT PRIMARY KEY,
	criacao DATE,
    atualizacao DATE,
    titulo VARCHAR(120),
    texto VARCHAR(10000),
    FOREIGN KEY(usuario_id) REFERENCES usuarios(usuario_id)
);

-- Listar usuarios cadastrados --
SELECT * FROM usuarios;

-- Remover trava de segurança do Delete -- 
SET SQL_SAFE_UPDATES=0;

-- Apagar Tabelas -- 
DROP TABLE anotacoes, usuarios;

-- Listar anotacoes registradas -- 
SELECT * FROM anotacoes;

-- Mecanismo de Listagem --
SELECT a.titulo Titulo, u.usuario Autor, a.criacao Em FROM anotacoes a, usuarios u WHERE u.usuario_id = a.usuario_id ORDER BY a.criacao DESC;

