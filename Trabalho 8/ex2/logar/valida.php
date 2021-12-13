<?php 
    require "../conexaoMysql.php";
    class RequestResponse{
        public $success;
        public $destination;
        
        function __construct($success, $destination){
            $this->success = $success;
            $this->destination = $destination;
        }
    }

    $sql = <<<SQL
        SELECT hash_senha 
        FROM trab6_ex3_login  
        WHERE email = ?
    SQL;

    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";

    try{
        $pdo = mysqlConnect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        $row = $stmt->fetch();
        if($row && password_verify($senha, $row["hash_senha"]) )
            echo json_encode(new RequestResponse(true, "logado.php")); 
        else
            echo json_encode(new RequestResponse(false, ""));
    }catch(Exception $e){
        echo json_encode(new RequestResponse(false, ""));
    }
?>