<!DOCTYPE html>
<html>
<head>
    <title>CRUD - intedisciplinar</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'><link rel="stylesheet" href="/estilos/crud.css">
    <style>
        body {
            background-color: #2C2A4A;
            font-family: Arial, sans-serif;
            color: #FFF;
            text-align: center;
            
        }

        form input[type="email"],
form input[type="password"] {
    padding: 10px;
    border-radius: 5px;
    border: none;
    margin-bottom: 20px;
    width: 40px; /* adicionado */
}
        body {
            display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    background-color: #483D8B;
        }
        
        .container {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .titulo {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .lista-usuarios {
            background-color: transparent;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: auto;
        }
        .lista-usuarios h2 {
            font-size: 24px;
            margin-top: 0;
        }
        .lista-usuarios ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .lista-usuarios li {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .deletar-conta {
            background-color: transparent;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .deletar-conta h2 {
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        form label {
            display: block;
            font-size: 16px;
            margin-bottom: 10px;
        }
        form input[type="email"],
        form input[type="password"] {
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 20px;
            width: 100%;
            background-color: #FFF;
            color: #2C2A4A;
        }
        form button[type="submit"] {
            background-color: #4B0082;
            color: #FFF;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            max-width: 200px;
            margin: 0 auto;
            display: block;
        }
        form button[type="submit"]:hover {
            background-color: #FFF;
            color: #4B0082;
        }
    </style>

</head>
<body>

<div class="lista-usuarios">
    <?php
// Configurações de conexão com o banco de dados
$host = 'containers-us-west-30.railway.app';
$user = 'root';
$pass = 'iF3b2b9fhZgSC8mznjwi';
$db = 'railway';
$port = '5896';

// Cria a conexão com o banco de dados
$conn = new mysqli($host, $user, $pass, $db, $port);

// Verifica se a conexão foi bem sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o formulário de deleção foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deletar"])) {
  // Obtém os dados do formulário
  $email = $_POST["email"];
  $senha = $_POST["senha"];

  // Consulta o usuário no banco de dados
  $sql = "SELECT id FROM usuarios WHERE email='$email' AND senha='$senha'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Encontrou um usuário com o e-mail e senha informados, então deleta
    $row = $result->fetch_assoc();
    $id = $row["id"];
    $sql = "DELETE FROM usuarios WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
      echo "Usuário deletado com sucesso!";
      // Recarrega a página
      echo "<script>window.location.reload();</script>";
    } else {
      echo "Erro ao deletar usuário: " . $conn->error;
    }
  } else {
    echo "E-mail ou senha inválidos.";
  }
}

// Monta a consulta SQL para obter os usuários
$sql = "SELECT nome, email FROM usuarios";

// Executa a consulta SQL
$result = $conn->query($sql);

// Exibe a lista de usuários em HTML
if ($result->num_rows > 0) {
    echo "<div class='lista-usuarios'>";
    echo "<h1>Lista de Usuarios</h1>";
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row["nome"] . " - " . $row["email"] . "</li>";
    }
    echo "</ul>";
    echo "</div>";
} else {
    echo "Não há usuários cadastrados.";
}

// Fecha a conexão com o banco de dados
//
?>

    </div>

   
<form method="post">
  <label for="email">E-mail:</label>
  <input type="email" name="email" id="email" required>
  <br>
  <label for="senha">Senha:</label>
  <input type="password" name="senha" id="senha" required>
  <br>
  <button type="submit" name="deletar">Deletar Conta</button>
</form>
<div class="deletar-conta">

<?php
// Verifica se o formulário de deleção foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deletar"])) {

  // Obtém os dados do formulário
  $email = $_POST["email"];
  $senha = $_POST["senha"];

  // Consulta o usuário no banco de dados
  $sql = "SELECT id FROM usuarios WHERE email='$email' AND senha='$senha'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Encontrou um usuário com o e-mail e senha informados, então deleta
    $row = $result->fetch_assoc();
    $id = $row["id"];
    $sql = "DELETE FROM usuarios WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
      echo "Usuário deletado com sucesso!";
      // Recarrega a página
    
    } else {
      echo "Erro ao deletar usuário: " . $conn->error;
    }
  } else {
    echo "E-mail ou senha inválidos.";
  }
}
$conn->close();
?>
</div>

    
    
</body>
</html>
