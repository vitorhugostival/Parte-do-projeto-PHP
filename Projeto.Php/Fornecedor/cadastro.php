<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $id_Fornecedor = $_POST['id_Fornecedor'];
    $razao_Social = $_POST['razao_Social'];
    $nome_Fornecedor = $_POST['nome_Fornecedor'];
    $apelido = $_POST['apelido'];
    $grupo = $_POST['grupo'];
    $sub_Grupo = $_POST['sub_Grupo'];
    $observacao = $_POST['observacao'];

    // Verifica se o id_Fornecedor já existe na tabela
    $sql_verifica = "SELECT * FROM fornecedor WHERE id_Fornecedor = '$id_Fornecedor'";
    $resultado_verifica = mysqli_query($conexao, $sql_verifica);

    if (mysqli_num_rows($resultado_verifica) > 0) {
        // Caso o ID já exista, exibe uma mensagem de erro
        echo "Erro: O ID do fornecedor já existe no sistema. Por favor, use um ID diferente.";
    } else {
        // Se o ID não existir, insere os dados
        $sql = "INSERT INTO fornecedor (id_Fornecedor, razao_Social, nome_Fornecedor, apelido, grupo, sub_Grupo, observacao) 
                VALUES ('$id_Fornecedor', '$razao_Social', '$nome_Fornecedor', '$apelido', '$grupo', '$sub_Grupo', '$observacao')";

        if (mysqli_query($conexao, $sql)) {
            echo "Dados salvos com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
        }
    }

    // Fechando a conexão com o banco de dados
    mysqli_close($conexao);
}
?>
