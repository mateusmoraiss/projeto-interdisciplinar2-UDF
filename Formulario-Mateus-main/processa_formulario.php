<?php

// Conexão com o banco de dados
$host = 'containers-us-west-30.railway.app';
$user = 'root';
$pass = 'iF3b2b9fhZgSC8mznjwi';
$db = 'railway';
$port = '5896';

$conn = new mysqli($host, $user, $pass, $db,$port);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
} 

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Obtém os dados do formulário
	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$senha = $_POST["senha"];

	// Insere os dados no banco de dados
	$sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

	if ($conn->query($sql) === TRUE) {
	    echo "Registro criado com sucesso, volte e tente fazer o login agora =)";
	} else {
	    echo "Erro ao criar registro: " . $conn->error;
	}
}

// Fecha a conexão com o banco de dados
$conn->close();

?>
