<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <?php include '../contents/metaGlobal.php'; ?>
    <link href="../contents/components.css" rel="stylesheet" type="text/css" />
    <title>Cadastrar Endereços</title>
  </head>
  <body>

    <?php include '../contents/headerPublic.php'; ?>
    <?php include '../contents/msg.php'; ?>

    <main class="cadastro-end">
      <div>
        <h2>Cadastro Endereços</h2>
      </div>
      <div>
        <form method="POST" class="row">
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
          <button id="btncadastrar">Cadastrar</button>
        </form>
      </div>

      <div class="msg">
        <span></span>
        <button onclick="msgHide()" type="button">OK</button>
      </div>

    </main>

    <?php include '../contents/footer.php';?>

    <script>

      let btncadastrar = document.getElementById("btncadastrar");
      
      function cadastrarEndereco() {
        let xhr = new XMLHttpRequest();
        let formData = new FormData(document.querySelector("form"));
        xhr.open("POST", "../scripts/cadastrarEndereco.php");

        xhr.onload = function () {
          
          let result;

          if (xhr.status != 200) {
            msgShow("Falha: " + xhr.status);
            return;
          }

          try {
            result = JSON.parse(xhr.responseText);
          }catch (e) {
            msgShow("String JSON inválida: " + xhr.responseText);
            return;
          }

          if (result.success == false)
            msgShow("Erro ao cadastro endereço " + result.message);
          else
            msgShow(result.message);
        }

        xhr.send(formData);
      }

      window.onload = (e) => {
        btncadastrar.onclick = (e) => {
          e.preventDefault();
          cadastrarEndereco();
        }
      }
      
    </script>
    
  </body>

</html>