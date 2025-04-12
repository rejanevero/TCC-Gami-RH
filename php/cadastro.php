<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="cadastro-colaborador.css">
</head>
<body>
    <div class="resposta">
        <?php
        // Conexão com o banco de dados
        $host = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "sistema_gami";
        $conn = new mysqli($host, $usuario, $senha, $banco);


        if ($conn->connect_error) {
            die("<h2>Erro na conexão com o banco de dados</h2><p>" . $conn->connect_error . "</p>");
        }


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nomeColaborador'];
            $email = $_POST['email'];


            $sql = "INSERT INTO Colaborador (nomeColaborador, email) VALUES ('$nome', '$email')";


            if ($conn->query($sql) === TRUE) {
                echo "<h2>Cadastro realizado com sucesso!</h2>";
                echo "<p><strong>Nome:</strong> $nome</p>";
                echo "<p><strong>Email:</strong> $email</p>";
            } else {
                echo "<h2>Erro ao cadastrar</h2>";
                echo "<p>" . $conn->error . "</p>";
            }
        } else {
            echo "<h2>Acesso inválido.</h2>";
        }


        $conn->close();
        ?>
        <a href="cadastro-colaborador.html">Voltar para o formulário</a>
    </div>
</body>
</html>
