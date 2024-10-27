<?php
    include("conexao.php");

    $id_Entrada = $_POST['id_Entrada'];
    $id_Usuario = $_POST['id_Usuario'];
    $nome_Usuario = $_POST['nome_Usuario'];
    $id_Fornecedor = $_POST['id_Fornecedor'];
    $nome_Fornecedor = $_POST['nome_Fornecedor'];
    $cod_Produto = $_POST['cod_Produto'];
    $nome_Produto = $_POST['nome_Produto'];
    $id_Estoque = $_POST['id_Estoque'];
    $qtd_Entrada = $_POST['qtd_Entrada'];
    $preco_Custo = $_POST['preco_Custo'];
    $sub_Grupo = $_POST['sub_Grupo'];
    $valor_Total = $_POST['valor_Total'];
    $data_Entrada = $_POST['data_Entrada'];

    // Função para verificar ID semelhante
    function verificaIDSemelhante($conexao, $campo, $valor, $nomeCampo) {
        $sql = "SELECT $campo FROM entrada_produtos WHERE $campo LIKE ?";
        $like_valor = "%" . $valor . "%";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, 's', $like_valor);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            echo "Erro: Já existe um $nomeCampo semelhante cadastrado.<br>";
            mysqli_stmt_close($stmt);
            return true;  // Retorna true se encontrar um ID semelhante
        }

        mysqli_stmt_close($stmt);
        return false; // Retorna false se não encontrar duplicatas
    }

    // Verificações de IDs
    $erro = false;

    if (verificaIDSemelhante($conexao, 'id_Entrada', $id_Entrada, 'ID de Entrada')) {
        $erro = true;
    }
    if (verificaIDSemelhante($conexao, 'id_Usuario', $id_Usuario, 'ID de Usuário')) {
        $erro = true;
    }
    if (verificaIDSemelhante($conexao, 'id_Fornecedor', $id_Fornecedor, 'ID de Fornecedor')) {
        $erro = true;
    }
    if (verificaIDSemelhante($conexao, 'cod_Produto', $cod_Produto, 'Código de Produto')) {
        $erro = true;
    }
    if (verificaIDSemelhante($conexao, 'id_Estoque', $id_Estoque, 'ID de Estoque')) {
        $erro = true;
    }

    // Se houver algum erro de ID, interrompe a execução
    if ($erro) {
        echo "Erro: Não foi possível cadastrar devido a IDs semelhantes.";
    } else {
        // Se não houver erros, realiza a inserção
        $sql = "INSERT INTO entrada_produtos 
                (id_Entrada, id_Usuario, nome_Usuario, id_Fornecedor, nome_Fornecedor, cod_Produto, nome_Produto, id_Estoque, qtd_Entrada, preco_Custo, sub_Grupo, valor_Total, data_Entrada) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, 'iisisssiddsds', $id_Entrada, $id_Usuario, $nome_Usuario, $id_Fornecedor, $nome_Fornecedor, $cod_Produto, $nome_Produto, $id_Estoque, $qtd_Entrada, $preco_Custo, $sub_Grupo, $valor_Total, $data_Entrada);

        if (mysqli_stmt_execute($stmt)) {
            echo "Entrada de produto cadastrada com sucesso.";
        } else {
            echo "Erro: " . mysqli_error($conexao);
        }

        mysqli_stmt_close($stmt);
    }

    // Fecha a conexão
    mysqli_close($conexao);
?>

