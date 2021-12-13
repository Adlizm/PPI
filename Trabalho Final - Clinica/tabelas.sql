CREATE TABLE Clinica_Pessoa(
    Codigo int PRIMARY KEY auto_increment,
   	Nome varchar(50),
    Sexo char,
    Email varchar(50) UNIQUE,
    Telefone char(14),
    CEP char(9),
    Logradouro varchar(50),
    Cidade varchar(15),
    Estado char(2)
) ENGINE=InnoDB;

CREATE TABLE Clinica_EnderecosAJAX(
  CEP char(9) PRIMARY KEY,
  Logradouro varchar(50),
  Cidade varchar(15),
  Estado char(2)
) ENGINE=InnoDB;

CREATE TABLE Clinica_Funcionario(
  Codigo int PRIMARY KEY,
  DataContrato date,
  Salario double,
  SenhaHash varchar(255) NOT NULL,
  FOREIGN KEY (Codigo) REFERENCES Clinica_Pessoa(Codigo)
) ENGINE=InnoDB;

CREATE TABLE Clinica_Paciente(
  Codigo int PRIMARY KEY,
  Peso double,
  Altura double,
  TipoSanguineo varchar(3),
  FOREIGN KEY (Codigo) REFERENCES Clinica_Pessoa(Codigo)
) ENGINE=InnoDB;

CREATE TABLE Clinica_Medico(
  Codigo int PRIMARY KEY,
  Especialidade varchar(50),
  CRM varchar(20) UNIQUE,
  FOREIGN KEY (Codigo) REFERENCES Clinica_Funcionario(Codigo)
) ENGINE=InnoDB;

CREATE TABLE Clinica_Agenda(
    Codigo int PRIMARY KEY auto_increment,
   	Data date,
   	Horario INT,
   	Nome varchar(50),
    Sexo char,
    Email varchar(50),
    CodigoMedico int,
    FOREIGN KEY (CodigoMedico) REFERENCES Clinica_Medico(Codigo)
) ENGINE=InnoDB;