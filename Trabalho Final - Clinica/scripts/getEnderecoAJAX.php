<?php 
    require "conexaoMysql.php";

    class EnderecoAJAX{ 
        public $logradouro;
        public $cidade;
        public $estado;

        function __construct($logradouro, $cidade, $estado){
            $this->logradouro = $logradouro;
            $this->cidade = $cidade;
            $this->estado = $estado;
        }
    }
    $sql = <<<SQL
        SELECT Logradouro, Cidade, Estado 
        FROM Clinica_EnderecosAJAX 
        WHERE CEP = ?;
    SQL;

    if(isset($_GET["cep"])){
        $cep = $_GET["cep"];
        try{
            $pdo = mysqlConnect();
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$cep]);

            if($row = $stmt->fetch()){
                echo json_encode(new EnderecoAJAX($row["Logradouro"], $row["Cidade"], $row["Estado"]));
                exit(); 
            }
        }catch(Exception $e){}
    }

    echo json_encode(new EnderecoAJAX("", "", ""));
    exit();
?>