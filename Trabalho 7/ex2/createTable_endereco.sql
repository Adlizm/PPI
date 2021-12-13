CREATE TABLE trab7_endereco(
   id INT PRIMARY KEY auto_increment,
   cep char(9) UNIQUE,
   rua varchar(50),
   bairro varchar(50),
   cidade varchar(50)
) ENGINE=InnoDB;

INSERT INTO trab7_endereco(cep, rua, bairro, cidade) VALUES ('38400-100', 'Av João Naves', 'Santa Mônica', 'Uberlândia');
INSERT INTO trab7_endereco(cep, rua, bairro, cidade) VALUES ('38400-200', 'Av Floriano Peixoto', 'Centro', 'Uberlândia');
INSERT INTO trab7_endereco(cep, rua, bairro, cidade) VALUES ('38400-300', 'Av Afonso Pena','Martins', 'Uberlândia');