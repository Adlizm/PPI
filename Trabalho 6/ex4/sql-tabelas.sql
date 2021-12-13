CREATE TABLE trab6_ex4_pessoa(
   codigo int PRIMARY KEY,
   nome varchar(64), 
   sexo char(1),
   email varchar(64) UNIQUE,
   telefone char(9),
   cep char(8),
   logradouro varchar(64),
   Cidade varchar(32),
   estado char(2)
) ENGINE=InnoDB;

CREATE TABLE trab6_ex4_paciente(
   codigo int not null,
   peso float,
   altura float,
   tipoSanguineo varchar(3),
   FOREIGN KEY (codigo) REFERENCES trab6_ex4_pessoa(codigo)
) ENGINE=InnoDB;