<?php 
    function carregaStrings($arquivo){
        $arq = fopen($arquivo, "r");
        $index = 0;
        $strings = [];
        while(!feof($arq)){
            $strings[$index] = fgets($arq);
            $index++;
        }
        fclose($arq);
        return $strings;
    }
    if(isset($_POST["email"]) and isset($_POST["senha"])){
        $emails = carregaStrings("../ex3/email.txt");
        $senhas_hash = carregaStrings("../ex3/senhaHash.txt");
        $length = count($emails);

        $email = $_POST["email"];
        $senha = $_POST["senha"];

        for($i = 0; $i < $length; $i++){       
            if($email == $emails[$i] and password_verify($senha, $senhas_hash[$i])){
                header("Location: logado.php");
                exit();
            } 
        }
    }
    header("Location: index.html");
    exit();
?>