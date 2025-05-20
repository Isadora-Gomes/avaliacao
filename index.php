<!-- Isadora Gomes da Silva  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/hostcenter-icon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Reem+Kufi:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/tarefas.css">
    <title>Lista de tarefas</title>
</head>
<body>
    <header>
        <div id="container">
            <a href="index.php" id="box-img"><img class= "logo" src="./img/tasksync.png" alt="logo"></li></a>
            <nav>
                <ul id="nav1">
                    <li><h3><a href="./cadastroUser.php">cadastro</a></h3></li>
                    <li><h3><a href="./cadastroTarefas.php">adicionar tarefa</a></h3></li>
                    <li><h3><a href="./index.php">tarefas</a></h3></li>
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
                    <li><h3><a href="./index.php">tarefas</a></h3></li>
                </ul>
            </nav>
        </div>
    </header>
 
    <section id="hm">
        <?php
        include 'conexao.php';
session_start();
        $sql_tarefas = "SELECT usuarios.nome_usuario, tarefas.descricao_tarefa, tarefas.setor_empresa, tarefas.prioridade_tarefa, tarefas.data_cadastrada, tarefas.status_tarefa 
    FROM usuarios INNER JOIN tarefas ON tarefas.id_usuario = usuarios.id_usuario";
    
    $resultado_tarefas = $conexao->query($sql_tarefas);
        ?>
        <h1 id="mural">Mural de tarefas</h1>
        <div id="addTask">
            <div id="tarefas">
            <?php
                    if ($resultado_tarefas->num_rows > 0) {
                        while($linha = $resultado_tarefas->fetch_assoc()){
                            echo "<div class='data'>";
                            echo "<p>" . $linha['nome_usuario'] . "</p>";
                            echo "<p>" . $linha['descricao_tarefa'] . "</p>";
                            echo "<p>" . $linha['setor_empresa'] . "</p>";
                            echo "<p>" . $linha['prioridade_tarefa'] . "</p>";
                            echo "<p>" . $linha['data_cadastrada'] . "</p>";
                            echo "<p>" . $linha['status_tarefa'] . "</p>";
                            echo "</div>";
                        }                   
                    }
                        ?>
        </div>
                </div>
                    </section>
</body>
</html>