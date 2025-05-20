<?php
include 'conexao.php';
session_start();
 if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['descricao_tarefa'], $_POST['setor_empresa'], $_POST['prioridade_tarefa'], $_POST['data_cadastrada'], $_POST['status_tarefa'])) {

    $id_user = $_SESSION['id_user'];
    $id_tarefa = $_POST['id_tarefa'];
    $descricao_tarefa = $_POST['descricao_tarefa'];
    $setor_empresa = $_POST['setor_empresa'];
    $prioridade_tarefa = $_POST['prioridade_tarefa'];
    $data_cadastrada = $_POST['data_cadastrada'];
    $status_tarefa = $_POST['status_tarefa'];

    $sql_insercao = "INSERT INTO tarefas (id_user, id_tarefa, descricao_tarefa, setor_empresa, prioridade_tarefa, data_cadastrada, status_tarefa
                            VALUES (?, ?, ?, ?, ?, ?, ?) ";

    $stmt = $conexao->prepare($sql_insercao);
    $stmt->bind_param("iisssss", $id_user, $id_tarefa, $descricao_tarefa, $setor_empresa, $prioridade_tarefa, $data_cadastrada, $status_tarefa);

    if ($stmt->execute()) {
        echo '<script>
                Swal.fire({
                    text: "Tarefa adicionada com sucesso!",
                    icon: "success"
                });
              </script>';
    } else {
        echo "Erro ao inserir os dados: " . $stmt->error;
    }
}
   $sql_conteudo = "SELECT * FROM tarefas";
    $resultado_conteudo_pagina = $conexao->query($sql_conteudo);

                    if ($resultado_conteudo_pagina->num_rows > 0) {
                        while($linha = $resultado_conteudo_pagina->fetch_assoc()){
                            echo "<div class='data'>";
                            echo "<form class='nova-secao' action='' method='POST'>
                    <h2 id='nova'>Adicionar tarefa</h2>

                    <label for='descricao'>Descrição</label>
                    <input id='desc' name='descricao' type='text' required></input>

                    <label for='setor'>Setor da empresa</label>
                    <input id='set' name='setor' type='text' required></input>

                    <label for='prioridade'>Prioridade da tarefa</label>
                    <input id='prio' name='prioridade' type='text'></input>

                    <label for='data'>Data</label>
                    <input id='date' name='data' type='date' required></input>

                    <label for='status'>Status</label>
                    <input id='stat' name='status' type='text' required></input>

                    <button type='submit' id='add'>Adicionar</button>
                </form>";
                            echo "<div>";
                        }                   
                    }
?>