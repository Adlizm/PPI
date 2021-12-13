<?php 
  require "../scripts/checkLoginData.php";

  if(!checkLogin()){
    header("Location: ../public/login.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <?php include '../contents/metaGlobal.php'; ?>
    <link href="../contents/components.css" rel="stylesheet" type="text/css" />
    <title>Cadastro de Pacientes</title>
  </head>
  <body>
    <?php include '../contents/headerPrivate.php'; ?>
    <main class="cadastro-pac">
      <div>
        <h2>Cadastro de Pacientes</h2>
      </div>
      <div>
        <form action="../scripts/cadastrarPaciente.php" method="POST" class="row">
          <div class="col-sm-12">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="Digite seu Nome" required>
          </div>
          <div class="col-sm-12">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Digite seu email" required>
          </div>
          <div class="col-md-5">
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" id="telefone" placeholder="Ex.: (99)99999-9999" required>
          </div>
          <div class="col-md-7">
            <label>Sexo</label>
            <div class="input-sexo">
              <label for="sMasculino">Masculino</label>
              <input type="radio" name="sexo" id="sMasculino" value="M" checked>
            </div>
            <div class="input-sexo">
              <label for="sFeminino">Feminino</label>
              <input type="radio" name="sexo" id="sFeminino" value="F">
            </div>
          </div>
          
          <div class="col-md-6">
            <label for="cep">CEP</label>
            <input type="text" name="cep" id="cep" placeholder="Ex.: 99999-999" pattern="\d{5}-\d{3}"  required>
          </div>
          <div class="col-md-6">
            <label for="logradouro">Logradouro</label>
            <input type="text" name="logradouro" id="logradouro" placeholder="Digite o lougrauro" required>
          </div>
          <div class="col-md-6">
            <label for="estado">Estado</label>
            <select id="estado" name="estado" class="form-select" required>
              <option value="" selected>Selecione</option>
              <option value="AC">AC</option>
              <option value="AL">AL</option>
              <option value="AP">AP</option>
              <option value="AM">AM</option>
              <option value="BA">BA</option>
              <option value="CE">CE</option>
              <option value="DF">DF</option>
              <option value="ES">ES</option>
              <option value="GO">GO</option>
              <option value="MA">MA</option>
              <option value="MT">MT</option>
              <option value="MS">MS</option>
              <option value="MG">MG</option>
              <option value="PA">PA</option>
              <option value="PB">PB</option>
              <option value="PR">PR</option>
              <option value="PE">PE</option>
              <option value="PI">PI</option>
              <option value="RJ">RJ</option>
              <option value="RN">RN</option>
              <option value="RS">RS</option>
              <option value="RO">RO</option>
              <option value="RR">RR</option>
              <option value="RC">RC</option>
              <option value="SP">SP</option>
              <option value="SE">SE</option>
              <option value="TO">TO</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="cidade">Cidade</label>
            <input type="text" name="cidade" id="cidade"  placeholder="Digite a cidade" required>
          </div>

          <div class="col-sm-4">
            <label for="peso">Peso</label>
            <input type="number" name="peso" id="peso" min="0" step="0.1" value="60.00" required>
          </div>
          <div class="col-sm-4">
            <label for="altura">Altura</label>
            <input type="number" name="altura" id="altura" min="0" step="0.01" value="1.70" required>
          </div>
            <div class="col-sm-4">
            <label for="tipoSang">Tipo Saguineo</label>
            <select name="tipoSang" id="tipoSang" required>
              <option value="" selected>Selecione</option>
              <option value="O+">O+</option>
              <option value="O-">O-</option>
              <option value="A+">A+</option>
              <option value="A-">A-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
            </select>
          </div>
          <button>Cadastrar</button>
        </form>
      </div>
      <div class="msg">
        <span></span>
        <button onclick="msgHide()" type="button">OK</button>
      </div>
    </main>

    <?php include '../contents/footer.php';?>
    <?php include "../contents/msg.php"; ?>
    
    <script>

      window.onload = (e) => {
        
        <?php
          // evita injeção de html
          if (isset($_GET['retorno']))
          echo 'msgShow("'.htmlspecialchars($_GET['retorno']).'");'
        ?>

        const inputCEP = document.getElementById("cep");
        inputCEP.onchange = () => {
          const inputLogradouro = document.getElementById("logradouro");
          const inputCidade = document.getElementById("cidade");
          const inputEstado = document.getElementById("estado");

          if(inputCEP.value.length == 9){
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "../scripts/getEnderecoAJAX.php?cep="+inputCEP.value);

            xhr.onload = () => {
              try{
                var response = JSON.parse(xhr.responseText);
                inputLogradouro.value = response.logradouro;
                inputCidade.value = response.cidade;
                inputEstado.value = response.estado;
              }catch(e){
                console.log(e);
              }
            }
            
            xhr.send();
          }
        }
      }

    </script>

  </body>
</html>