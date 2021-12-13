CREATE TABLE trab6_ex3_login(
   id int PRIMARY KEY auto_increment,
   email varchar(64) UNIQUE, 
   hash_senha varchar(255) 
) ENGINE=InnoDB;
