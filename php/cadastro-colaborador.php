<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="./img/favicon/pranchetafavicon-32x32.png">
    <link rel="stylesheet" href="./css/cadastro-colaborador.css">
    <title>Cadastro Colaborador</title>  
</head>
<body>
    <div class="resposta">
        <?php
        // Conexão com o banco de dados
        $host = "localhost";
        $usuario = "root";
        $senha = "usbw";
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
