<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['nome_usuario'], $_POST['descricao_tarefa'], $_POST['setor_empresa'], $_POST['prioridade_tarefa'], $_POST['data_cadastrada'], $_POST['status_tarefa'])) {

    $nome_usuario = $_POST['nome_usuario'];
    $descricao_tarefa = $_POST['descricao_tarefa'];
    $setor_empresa = $_POST['setor_empresa'];
    $prioridade_tarefa = $_POST['prioridade_tarefa'];
    $data_cadastrada = $_POST['data_cadastrada'];
    $status_tarefa = $_POST['status_tarefa'];


    $stmt = $conexao->prepare("SELECT id_usuario FROM usuarios WHERE nome_usuario = ?");
    $stmt->bind_param("s", $nome_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();
        $id_usuario = $linha['id_usuario'];
    } else {
        
        $stmt = $conexao->prepare("INSERT INTO usuarios (nome_usuario) VALUES (?)");
        $stmt->bind_param("s", $nome_usuario);
        $stmt->execute();
        $id_usuario = $stmt->insert_id;
    }

    $sql = "INSERT INTO tarefas (id_usuario, descricao_tarefa, setor_empresa, prioridade_tarefa, data_cadastrada, status_tarefa)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("isssss", $id_usuario, $descricao_tarefa, $setor_empresa, $prioridade_tarefa, $data_cadastrada, $status_tarefa);

    if ($stmt->execute()) {
        echo "Tarefa adicionada com sucesso!";
    } else {
        echo "Erro ao adicionar tarefa: " . $stmt->error;
    }
}
?>
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
    <link rel="stylesheet" href="./css/add.css">
    <title>Adicionar tarefas</title>
</head>
<section id="form-section">
  <form action="addTarefas.php" method="POST" id="form-tarefa">
    <h2>Adicionar tarefa</h2>

    <div class="form-group">
      <label for="nome_usuario">Seu nome:</label>
      <input type="text" name="nome_usuario" id="nome_usuario" required>
    </div>

    <div class="form-group">
      <label for="descricao_tarefa">Descrição:</label>
      <input type="text" name="descricao_tarefa" id="descricao_tarefa" required>
    </div>

    <div class="form-group">
      <label for="setor_empresa">Setor:</label>
      <input type="text" name="setor_empresa" id="setor_empresa" required>
    </div>

    <div class="form-group">
      <label for="prioridade_tarefa">Prioridade da tarefa:</label>
      <select name="prioridade_tarefa" id="prioridade_tarefa" required>
        <option value="">Selecione</option>
        <option value="baixa">Baixa</option>
        <option value="média">Média</option>
        <option value="alta">Alta</option>
      </select>
    </div>

    <div class="form-group">
      <label for="data_cadastrada">Data:</label>
      <input type="datetime-local" name="data_cadastrada" id="data_cadastrada" required>
    </div>

    <div class="form-group">
      <label for="status_tarefa">Status:</label>
      <select name="status_tarefa" id="status_tarefa" required>
        <option value="">Selecione</option>
        <option value="a fazer">A Fazer</option>
        <option value="fazendo">Fazendo</option>
        <option value="concluído">Concluído</option>
      </select>
    </div>

    <button type="submit" id="btn-enviar">Salvar tarefa</button>
  </form>
  <a href="cadastroTarefas.php">Voltar</a>  
</section>
</html>

