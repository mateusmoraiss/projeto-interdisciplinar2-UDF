<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtém os dados do formulário
  $email = $_POST["email"];
  $senha = $_POST["senha"];

  $host = 'containers-us-west-30.railway.app';
  $user = 'root';
  $pass = 'iF3b2b9fhZgSC8mznjwi';
  $db = 'railway';
  $port = '5896';
  $conn = new mysqli($host, $user, $pass, $db,$port);

  // Verifica se a conexão foi bem sucedida
  if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
  }

  // Prepara a consulta SQL
  $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";

  // Executa a consulta SQL
  $result = $conn->query($sql);

  // Verifica se encontrou um registro correspondente aos dados informados
if ($result->num_rows > 0) {
    // Inicia a sessão do usuário e redireciona para a página de dashboard, por exemplo
    session_start();
    $_SESSION["email"] = $email;
    echo 'Email e senha corretos. Obrigado por chegar até aqui! <br> Atenciosamente, Mateus. =)';

    // Aguarda 10 segundos antes de redirecionar para a página do Google
    header("Refresh: 8; URL=https://mateus-to-do-dev.netlify.app");

    // Encerra o script
    exit();
} else {
    // Exibe uma mensagem de erro de login
    echo "Email ou senha incorretos.";
}


  // Fecha a conexão com o banco de dados
  $conn->close();
}
?>
