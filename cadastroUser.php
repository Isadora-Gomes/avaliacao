<!-- Isadora Gomes da Silva  -->
<?php
include 'conexao.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

    $sql_insercao = "INSERT INTO usuarios (nome_usuario, email_usuario, senha_usuario) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql_insercao);
    $stmt->bind_param("sss", $nome, $email, $senha_hashed);

        
    if ($stmt->execute()) {
        header("Location: cadastroTarefas.php");
    } else {
        echo "Erro ao cadastrar usuário: " . $conexao->error;
    }

    $stmt->close();
    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taks Sync - Cadastrar</title>
    <link rel="shortcut icon" href="img/hostcenter-icon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Reem+Kufi:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/cadastro.css">
</head>
<body>
<header>
        <div id="container">
            <a href="index.php" id="box-img"><img class= "logo" src="./img/tasksync.png" alt="logo"></li></a>
            <nav>
                <ul id="nav1">
                    <li><h3><a href="./cadastroUser.php">cadastro</a></h3></li>
                    <li><h3><a href="./cadastroTarefas.php">adicionar tarefa</a></h3></li>
                    <li><h3><a href="./gerenciamento.php">tarefas</a></h3></li>
                </ul>
                <div id="user-div">
                    <?php
                    if (isset($_SESSION['nome']) && $_SESSION['nome'] != ''){
                        echo "<select name='' id='user' onchange='sair()'>
                                <option value='' id='opt-nome'>".$_SESSION['nome']."</option>
                                <a><option value='' id='opt-sair'>Sair</option></a>
                            </select>";
                    } elseif (isset($_SESSION['nome']) && $_SESSION['nome'] == '') {
                        echo "<h3><a id='login' href='./login.php'>Entrar</a></h3>";
                    }
                    ?>
                    <script>
                        function sair(){
                            window.location.href = "./logout.php";
                        }
                    </script>
                </div>
                <input type="checkbox" id="checkbox">
                <label for="checkbox" id="botao">☰</label>
                <ul id="nav2">
                    <li><h3><a href="./cadastroUser.php">cadastro</a></h3></li>
                    <li><h3><a href="./cadastroTarefas.php">adicionar tarefa</a></h3></li>
                    <li><h3><a href="./gerenciamento.php">tarefas</a></h3></li>
                </ul>
            </nav>
        </div>
    </header>
    <section id="secao1">
        <div id="box-login">
            <div id="box-img-login">
                <img id="img-login" src="../avaliacao/img/tasksyncT.png" alt="">
            </div>
            <form action="" method="POST">
                <h1>CADASTRAR</h1>
                <h2>Crie uma conta</h2>
                <input class="inserir" type="text" name="nome" placeholder="Nome">

                <input class="inserir" type="email" name="email" placeholder="Email">

                <input class="inserir" type="password" name="senha" placeholder="Senha">
        
                <button id="entrar" type='submit'>Cadastrar</button>

            </form>
        </div>
    </section>
    <footer>
        <div class="flex">
            <i id="hotel" class="fa-solid fa-hotel"></i>
            <p>Task Sync</p> 
        </div>
        <div class="flex">
            <i class="fa-brands fa-instagram"></i>
            <a href="#">tasksync.solutions</a>
        </div>
    </footer>
</body>
</html>