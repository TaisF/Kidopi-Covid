<?php
//Api's
$br= "https://dev.kidopilabs.com.br/exercicio/covid.php?pais=Brazil";
$can = "https://dev.kidopilabs.com.br/exercicio/covid.php?pais=Canada";
$aus = "https://dev.kidopilabs.com.br/exercicio/covid.php?pais=Australia";

$brasil = json_decode(file_get_contents($br));
$canada = json_decode(file_get_contents($can));
$australia = json_decode(file_get_contents($aus));
?>

<!--Conexcao com o Banco-->
<?php 
include("backend/myconex.php");
$consulta = "SELECT * FROM `covid_access_log` ORDER BY id DESC LIMIT 1";
$con = $mysqli->query($consulta); 
$paises = $con->fetch_assoc();  

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="main.css">
  

  <title>Covid</title>
</head>
<body>
<header class="header">
<div class="header-1">
            <div class="logo">
                <img src="./img/kidopi.png">
            </div>

        </div>
        </header>
   <div class="middle">
<h1>
  Casos Confirmados
  <br>
   De Covid 19.
</h1>
 </div>
 <!--Começo das Colunas dos Paises-->

 <!-- Australia-->
<div class="column-container1">
    <div class="column">
    <p> Australia</p>
    <div class = "select">
  <form method="post" >
    <select class="ls-custom" name="au">
      <option value="#">Selecione um estado</option>
      <p>
        <?php
        foreach($australia as $informacoes){
          echo "<option value='".$informacoes -> ProvinciaEstado."'>".$informacoes -> ProvinciaEstado."</option>";
        }
      ?>
      </p>
    </select>
    <input type="hidden" value="Australia" name="pais">
    <button class="button" role="button" name="deus" value="1">Enviar</button>
      </div>

      </form>
      <?php error_reporting(0); ?> 
      <?php
      $estado = $_POST['au'];
      foreach($australia as $informacoes){
        if($informacoes -> ProvinciaEstado == $estado){
          echo "Estado: ".$informacoes -> ProvinciaEstado."<br>";
          echo "Casos confirmados: ".$informacoes->Confirmados."<br>";
          echo "Mortes Confirmadas: ".$informacoes->Mortos."<br>";
        }
      }
      
  ?>
      </div>
    </div>
<!--Brasil-->
<div class="column-container2">
    <div class="column">
      <p> Brasil</p>
      <div class = "select">
  <form method="post">
<select class="ls-custom" name="br">
      <option value="br">Selecione um estado</option>
      <?php
        foreach($brasil as $informacoes){
          echo "<option value='".$informacoes -> ProvinciaEstado."'>".$informacoes -> ProvinciaEstado."</option>";
        }
      ?>
</select>
<input type="hidden" value="Brasil" name="pais">
<button class="button" role="button" name="deus"  value="1" >Enviar</button>
</form>
<?php
      $estado = $_POST['br'];
      foreach($brasil as $informacoes){
        if($informacoes -> ProvinciaEstado == $estado){
          echo "Estado: ".$informacoes -> ProvinciaEstado."<br>";
          echo "Casos confirmados: ".$informacoes->Confirmados."<br>";
          echo "Mortes Confirmadas: ".$informacoes->Mortos."<br>";
        }
      }
  ?>
  </div>
      </div>
    </div>
    <!-- Canada-->
    <div class="column-container3">
 <div class="column">
 <p> Canadá</p>
 <div class = "select">
  <form method="post" >
<select class="ls-custom" name="can">
      <option value="#">Selecione um estado</option>
      <?php
        foreach($canada as $informacoes){
          echo "<option value='".$informacoes -> ProvinciaEstado."'>".$informacoes -> ProvinciaEstado."</option>";
        }
      ?>
    </select>
    <input type="hidden" value="Canada" name="pais">
    <button class="button" role="button" name="deus"  value="1">Enviar</button>
  </form>
 <?php
      $estado = $_POST['can'];
      foreach($canada as $informacoes){
        if($informacoes -> ProvinciaEstado == $estado){
          echo "Estado: ".$informacoes -> ProvinciaEstado."<br>";
          echo "Casos confirmados: ".$informacoes->Confirmados."<br>";
          echo "Mortes Confirmadas: ".$informacoes->Mortos."<br>";
        }
      }
  ?>
  </div>
</div>
    </div> 
    </div> 
    <!--Fim das Colunas dos Paises-->

<div class="rodape">
    <!--Waves Container-->
    <div>
        <svg
          class="waves"
          xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink"
          viewBox="0 24 150 28"
          preserveAspectRatio="none"
          shape-rendering="auto"
        >
          <defs>
            <path
              id="gentle-wave"
              d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"
            />
          </defs>
          <g class="parallax">
            <use
              xlink:href="#gentle-wave"
              x="48"
              y="0"
              fill="rgba(255,255,255,0.7"
            />
            <use
              xlink:href="#gentle-wave"
              x="48"
              y="3"
              fill="rgba(255,255,255,0.5)"
            />
            <use
              xlink:href="#gentle-wave"
              x="48"
              y="5"
              fill="rgba(255,255,255,0.3)"
            />
            <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
          </g>
        </svg>

      </div>
      <!--Waves end-->
      <!--Rodape com TimeStamp-->
      <footer>
     
      <div class="footer">
      <?php if($paises){
          echo "<td> ".$paises["paises"]."</td>";
          echo "<td> ".date("H:i d/m/Y ", strtotime($paises["data_hora"]))."</td>";  

      }
     
    ?></td>
   
    </div>
      </footer>
      <!--Rodape com TimeStamp-->
</div>
</body>
</html>
