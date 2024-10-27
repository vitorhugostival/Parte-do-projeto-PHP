
<?php
include("conexao.php");

// Verifique se os dados foram enviados corretamente
if (isset($_POST['id_Local']) && isset($_POST['nome_Local']) && isset($_POST['tipo_Local']) && isset($_POST['observacao'])) {
    $id_Local = $_POST['id_Local'];
    $nome_Local = $_POST['nome_Local'];
    $tipo_Local = $_POST['tipo_Local'];
    $observacao = $_POST['observacao'];

    // Verifica se o id_Local já existe no banco de dados
    $check_sql = "SELECT * FROM local_destino WHERE id_Local = '$id_Local'";
    $result = mysqli_query($conexao, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Erro: O ID já existe. Por favor, insira um ID único.";
    } else {
        // Inserção de novos dados com o campo observacao
        $sql = "INSERT INTO local_destino (id_Local, nome_Local, tipo_Local, observacao) VALUES ('$id_Local', '$nome_Local', '$tipo_Local', '$observacao')";
        
        if (mysqli_query($conexao, $sql)) {
            echo "Dados salvos com sucesso!";
        } else {
            echo "Erro ao inserir dados: " . mysqli_error($conexao);
        }
    }
} else {
    echo "Erro: Todos os campos são obrigatórios!";
}

mysqli_close($conexao);
?>
