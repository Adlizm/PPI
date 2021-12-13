CREATE TABLE trab6_ex2_endereco(
   id int PRIMARY KEY auto_increment,
   cep char(8), 
   logradouro varchar(64), 
   bairro varchar(32), 
   cidade varchar(32),
   estado char(2)
) ENGINE=InnoDB;
