<?php 
  require "../scripts/checkLoginData.php";

  if(!checkLogin() || !checkMedico()){
    header("Location: ../public/login.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <?php include '../contents/metaGlobal.php'; ?>
    <link href="../contents/components.css" rel="stylesheet" type="text/css" />
    <title>Listar Meus Agendamentos</title>
  </head>
  <body>
    <?php include '../contents/headerPrivate.php'; ?>
    <main class="listagem">
      <div>
        <h2>Meus Agendamentos</h2>
      </div>
      <div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Medico</th>
              <th scope="col">Data</th>
              <th scope="col">Horário</th>
              <th scope="col">Nome</th>
              <th scope="col">Sexo</th>
              <th scope="col">Email</th>
            </tr>
          </thead>
          <tbody>
            <?php 

              $sqlMy = <<<SQL
                SELECT Data, Horario, Clinica_Agenda.Nome, Clinica_Agenda.Sexo, Clinica_Agenda.Email, Clinica_Pessoa.Nome AS Medico 
                FROM Clinica_Agenda INNER JOIN Clinica_Pessoa ON  CodigoMedico = Clinica_Pessoa.Codigo
                WHERE CodigoMedico = ?;
              SQL;
              
              try{
                $codigo = $_SESSION["codigo"];
                $pdo = mysqlConnect();

                $stmt = $pdo->prepare($sqlMy);
                $stmt->execute([$codigo]);

                while($row = $stmt->fetch()){
                  $medico = htmlspecialchars($row["Medico"]);
                  $data = htmlspecialchars($row["Data"]);
                  $horario = htmlspecialchars($row["Horario"]);
                  $nome = htmlspecialchars($row["Nome"]);
                  $sexo = htmlspecialchars($row["Sexo"]);
                  $email = htmlspecialchars($row["Email"]);
  
                  echo <<<TR
                    <tr>
                      <td>$medico</td>
                      <td>$data</td>
                      <td>$horario</td>
                      <td>$nome</td>
                      <td>$sexo</td>
                      <td>$email</td>
                    </tr>
                  TR;
                }
              }catch(Exception $e){
                exit($e->getMessage());
                echo <<<TR
                  <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                  </tr>
                TR;
              }
            ?>
          </tbody>
        </table>
      </div>
    </main>
    <?php include '../contents/footer.php';?>
  </body>
</html>