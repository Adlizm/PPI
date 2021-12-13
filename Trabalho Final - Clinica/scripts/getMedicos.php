<?php 
    require "conexaoMysql.php";

    class Medico{
        public $codigo;
        public $nome;
        public $crm;

        function __construct($codigo, $nome, $crm){
            $this->codigo = $codigo;
            $this->nome = $nome;
            $this->crm = $crm;
        }
    }
    if(!isset($_GET["especialidade"]))
        exit(json_encode([]));
        
    $especialidade = $_GET["especialidade"];

    $sql = <<<SQL
        SELECT Clinica_Medico.Codigo, Nome, CRM 
        FROM Clinica_Medico INNER JOIN Clinica_Pessoa ON
            Clinica_Medico.Codigo = Clinica_Pessoa.Codigo
        WHERE Especialidade = ?;
    SQL;

    $medicos = [];
    try{
        $pdo = mysqlConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$especialidade]);

        $i = 0;
        while($row = $stmt->fetch()){
            $medicos[$i++] = new Medico($row["Codigo"], $row["Nome"], $row["CRM"]);
        }
    }catch(Exception $e){
        exit(json_encode($medicos));
    }
    
    exit(json_encode($medicos));
?>