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
    <title>Cadastro de Funcionários</title>
  </head>
  <body>
    <?php include '../contents/headerPrivate.php'; ?>
    <main class="cadastro-fun">
      <div>
        <h2>Cadastro de Funcionários</h2>
      </div>
      <div>
        <form action="../scripts/cadastrarFuncionario.php" method="POST" class="row">
          <div class="col-sm-12">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="Digite seu Nome" required>
          </div>
          <div class="col-sm-12">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Digite seu email" required>
          </div>
          <div class="col-sm-12">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
          </div>
          <div class="col-md-6">
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" id="telefone" placeholder="Ex.: (99)99999-9999" required>
          </div>
          <div class="col-md-6">
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

          <div class="col-md-12">
            <label for="cidade">Cidade</label>
            <input type="text" name="cidade" id="cidade"  placeholder="Digite a cidade" required>
          </div>

          <div class="col-md-12">
            <label for="logradouro">Logradouro</label>
            <input type="text" name="logradouro" id="logradouro" placeholder="Digite o logradouro" required>
          </div>

          <div class="col-sm-12">
            <label for="dataIC">Data de Inicio</label>
            <input type="date" name="dataIC" id="dataIC" required>
          </div>

          <div class="col-8">
            <label for="salario">Salario</label>
            <input type="number" name="salario" id="salario"  placeholder="Digite a salario" min="0" step="0.01" value="999.99" required>
          </div>
          <div class="col-4">
            <label for="medico">Medico</label>
            <input type="checkbox" name="medico" id="medico">
          </div>

          <div id="divespecialidade" class="col-sm-7 not-shown">
            <label for="especialidade">Especialidade</label>
            <input type="text" name="especialidade" id="especialidade" placeholder="Digite a especialidade">
          </div>
          <div id="divcrm" class="col-sm-5 not-shown">
            <label for="crm">CRM</label>
            <input type="text" name="crm" id="crm" placeholder="Digite o CRM">
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
      let medico = document.getElementById("medico");
      let divespecialidade = document.getElementById("divespecialidade");
      let divcrm = document.getElementById("divcrm");
      let especialidade = document.getElementById("especialidade");
      let crm = document.getElementById("crm");

      window.onload = (e) => {
        
        <?php
          // evita injeção de html
          if (isset($_GET['retorno']))
          echo 'msgShow("'.htmlspecialchars($_GET['retorno']).'");'
        ?>
        
        medico.onchange = (e) => {
          
          if(medico.checked == true){
            especialidade.required = true;
            crm.required = true;
            divcrm.style.display = "flex";
            divespecialidade.style.display = "flex";
          }else{
            especialidade.required = false;
            crm.required = false;
            divespecialidade.style.display = "none";
            divcrm.style.display = "none";
          }
        }

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