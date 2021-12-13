<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    
    <title>Exercício 1 - Apresentação dos Dados</title>
    <style>
        div.row > div{
            backgroud-color: #eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php 
            $cep = "-";
            $logradouro = "-";
            $bairro = "-";
            $cidade = "-";
            $estado = "-";
            if(isset($_POST["cep"]))
                $cep = $_POST["cep"];

            if(isset($_POST["logradouro"]))
                $logradouro = $_POST["logradouro"];

            if(isset($_POST["bairro"]))
                $bairro = $_POST["bairro"];
            
            if(isset($_POST["cidade"]))
                $cidade = $_POST["cidade"];

            if(isset($_POST["estado"]))
                $estado = $_POST["estado"];

            $str = <<<DADOS
            <div class="row">
                <div class="col-sm-2">$cep</div>
                <div class="col-sm-4">$logradouro</div>
                <div class="col-sm-2">$bairro</div>
                <div class="col-sm-3">$cidade</div>
                <div class="col-sm-1">$estado</div>
            </div>
            DADOS;
            echo $str;
        ?>
    </div>
</body>
</html>
