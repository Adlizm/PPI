<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <?php include "../contents/metaGlobal.php"; ?>
    <link href="../contents/components.css" rel="stylesheet" type="text/css" />
    <title>Agendamentos</title>
  </head>
  <body>
    <?php include '../contents/headerPublic.php'; ?>
    <main class="Agendamento">
      <div>
        <h2>Agendamento</h2>
      </div>
      <div>
        <form method="POST" class="row">
          <div class="col-sm-12">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="Digite seu Nome" required>
          </div>
          <div class="col-md-6">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Digite seu email" required>
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
          <div class="col-sm-6">
            <label for="especialidade">Especialidade</label>
            <select name="especialidade" id="especialidade" required>
              <option value="" selected>Selecione</option>

            </select>
          </div>
          <div class="col-sm-6">
            <label for="medico">Medico</label>
            <select name="medico" id="medico" required>
              <option value="" selected>Selecione</option>
              
            </select>
          </div>
          <div class="col-sm-6">
            <label for="dataConsulta">Data</label>
            <input type="date" name="dataConsulta" id="dataConsulta" required>
          </div>
          <div class="col-sm-6">
            <label for="horario">Horario</label>
            <select name="horario" id="horario" required>
              <option value="" selected>Selecione</option>
              
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
    <?php include "../contents/footer.php";?>
    <?php include "../contents/msg.php";?>

    <script>
      window.onload = () => {
        const inputData = document.getElementById("dataConsulta")
        const selectEspecialidade = document.getElementById("especialidade"); 
        const selectMedico = document.getElementById("medico"); 
        const selectHorario = document.getElementById("horario"); 

        function setMedicoOptions(medicos){
          selectMedico.innerHTML = "";
          for(let medico of medicos){
            let element = document.createElement("option");
            element.innerText = medico["nome"];
            element.value = medico["codigo"];

            selectMedico.appendChild(element);
          }
        }

        function setOptions(select, options){
          select.innerHTML = "";
          for(let option of options){
            let element = document.createElement("option");
            element.innerText = option;
            element.value = option;

            select.appendChild(element);
          }
        }

        function getEspecialidades(){
          let xhr = new XMLHttpRequest();
          xhr.open("GET", "../scripts/getEspecialidades.php");

          xhr.onload = () => {
            try {
              var especialidades = JSON.parse(xhr.responseText);
              setOptions(selectEspecialidade, especialidades);
              getMedicos();
            }catch (e) {
              setOptions(selectEspecialidade, []);
            }
          }
          xhr.send();
        }

        function getMedicos(){
          let xhr = new XMLHttpRequest();

          xhr.open("GET", "../scripts/getMedicos.php?especialidade="+selectEspecialidade.value);
         
          xhr.onload = () => {
            try {
              var medicos = JSON.parse(xhr.responseText);
              setMedicoOptions(medicos);
              getHorarios();
            }catch (e) {
              setMedicoOptions([]);
            }
          }

          xhr.send();
        }

        function getHorarios(){
          let xhr = new XMLHttpRequest();
  
          xhr.open("GET", "../scripts/getHorarios.php?data="+inputData.value+"&codigo="+selectMedico.value);

          xhr.onload = () => {
            try {
              var horarios = JSON.parse(xhr.responseText);
              setOptions(selectHorario, horarios);
            }catch (e) {
              setOptions(selectHorario, []);
            }
          }
          xhr.send();
        }

        selectEspecialidade.onchange = getMedicos;
        selectMedico.onchange = getHorarios;
        inputData.onchange = getHorarios;

        const btnCadastra = document.querySelector("form > button");
        btnCadastra.onclick = (e) => {
          e.preventDefault();
          
          let xhr = new XMLHttpRequest();
          let formData = new FormData(document.querySelector("form"));
          xhr.open("POST", "../scripts/realizarAgendamento.php");

          xhr.onload = function(){
            try {
              var result = JSON.parse(xhr.responseText);
            }catch (e) {
              msgShow("String JSON inválida! ");
              return;
            }
            msgShow(result.message);
          }

          xhr.send(formData);
        }

        getEspecialidades();
      }
    </script>
  </body>
</html>