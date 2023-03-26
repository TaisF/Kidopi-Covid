<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$bd = "covid";

// faz a conexão com o banco de dados
$mysqli = new mysqli($host, $usuario, $senha, $bd);

// verifica se a conexão foi bem sucedida
if ($mysqli->connect_errno){ 
    echo "Conexão está com erro: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$date_hora = new DateTime();
$deus = isset($_REQUEST['deus']) && $_REQUEST['deus'] == 1 ? $_REQUEST['deus'] : null;

if ($deus) {
    file_put_contents("tt.txt", print_r($_REQUEST, true), FILE_APPEND);
    $paises = $_POST['pais'];
    $sql = "INSERT INTO covid_access_log (paises, data_hora	) VALUES ('$paises', NOW())";
    $con = $mysqli->query($sql) or die ($mysqli->error); 
}

?>