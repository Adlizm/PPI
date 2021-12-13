<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    
    <title>Exercício 2</title>
</head>
<body>
    <div class="container">
        <?php 
            $produtos = [
                "Abajur", "Banana", "Carro", "Colar", "Mesa",
                "Tapete", "Geladeira", "Bola", "Blusa", "Relogio"
            ];
            $descricoes = [
                "Objeto usado para iluminacao em escrivaninhas",
                "Fruta amarela com formato de meia lua",
                "Automovel de quatro rodas",
                "Acessorio usado no pescoço",
                "Objeto com superficie para apoiar utencilhos",
                "Tecido colocado no chao para limpar sapatos",
                "Eletrodomestico usado para conservar alimentos com baixas temperaturas",
                "Brinquedo usado em esporte de formato esferico",
                "Vestimenta usado para cobrir o torax",
                "Objeto mecanico que marca o horário"
            ];

            $qde = 0;
            if(isset($_GET["qde"]))
                $qde = $_GET["qde"];

            $content_table = "";
            for($i = 0; $i < $qde; $i++){
                $id = rand(0, 9);
                $produto = $produtos[$id];
                $descricao = $descricoes[$id];
                

                $content_table .= "<tr>";
                $content_table .= "<td>$id</td>";
                $content_table .= "<td>$produto</td>";
                $content_table .= "<td>$descricao</td>";
                $content_table .= "</tr>";
            }
            
            $table = <<<TABLE
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Descricao</th>
                    </tr>
                </thead>
                <tbody>
                    $content_table
                </tbody>
            </table>
            TABLE;
            echo $table;
        ?>
    </div>
</body>
</html>