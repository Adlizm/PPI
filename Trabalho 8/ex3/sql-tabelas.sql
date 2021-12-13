CREATE TABLE trab7_medicos(
   id INT PRIMARY KEY auto_increment,
   nome_medico varchar(32),
   telefone_medico varchar(16),
   especialidade_medico varchar(32)
) ENGINE=InnoDB;


INSERT INTO trab7_medicos(nome_medico, telefone_medico, especialidade_medico) VALUES ("Andre", "389758-0045", "cardiologia");
INSERT INTO trab7_medicos(nome_medico, telefone_medico, especialidade_medico) VALUES ("Bianca", "349852-0045", "cardiologia");
INSERT INTO trab7_medicos(nome_medico, telefone_medico, especialidade_medico) VALUES ("Lucas", "3498504-0045", "cardiologia");

INSERT INTO trab7_medicos(nome_medico, telefone_medico, especialidade_medico) VALUES ("Tais", "349902-5422", "dermatologia");
INSERT INTO trab7_medicos(nome_medico, telefone_medico, especialidade_medico) VALUES ("Arthur", "349922-1343", "dermatologia");
INSERT INTO trab7_medicos(nome_medico, telefone_medico, especialidade_medico) VALUES ("Paulo", "389752-5048", "dermatologia");

INSERT INTO trab7_medicos(nome_medico, telefone_medico, especialidade_medico) VALUES ("Ana", "389869-1336", "oftalmologia");
INSERT INTO trab7_medicos(nome_medico, telefone_medico, especialidade_medico) VALUES ("Luiz", "349985-1505", "oftalmologia");
INSERT INTO trab7_medicos(nome_medico, telefone_medico, especialidade_medico) VALUES ("Bruna", "349760-0036", "oftalmologia");