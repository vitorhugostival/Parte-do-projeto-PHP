<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>  	
<h1>Fornecedor</h1>
<form action="cadastro.php" method="POST" class="center-form">
    <label for="id_Fornecedor">ID Fornecedor: </label>
    <input type="number" name="id_Fornecedor" class="form-control" required>
    <br>

    <label for="razao">Razão Social: </label>
    <input type="text" name="razao_Social" class="form-control" required>
    <br>

    <label for="nome_fornecedor">Nome Fornecedor: </label>
    <input type="text" name="nome_Fornecedor" class="form-control" required>
    <br>

    <label for="apelido">Apelido: </label>
    <input type="text" name="apelido" class="form-control" required>
    <br>

    <label for="grupo">Grupo: </label>
    <input type="text" name="grupo" class="form-control" required>
    <br>

    <label for="sub_Grupo">Subgrupo: </label>
    <input type="text" name="sub_Grupo" class="form-control">
    <br>

    <label for="observacao">Observação: </label>
    <textarea name="observacao" class="form-control"></textarea>
    <br>

    <button type="submit" class="btn side-button">Salvar</button>
</form>

<br>  
<h2>Excluir</h2>
<form action="delet.php" method="POST" class="delete-form">
    <label for="deletar">Digite o id para excluir o fornecedor</label>
    <input type="text" name="deletar" id="deletar" placeholder="Excluir" class="form-control" required>
    <br>
    <input type="submit" value="Excluir ID" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir o Produto?');">
</form>
    
<br>

<a href="atualizacaodefornecedor.php" class="btn side-button">Atualizar Dados</a>
<br>

<a href="pesquisar.php" class="btn side-button">Pesquisar Produtos</a>
<br>

<h2>Tabela de Fornecedores</h2><br>

<?php
include("conexao.php");

// Consulta que inclui todos os campos adicionais
$sql = "SELECT id_Fornecedor, razao_Social, nome_Fornecedor, apelido, grupo, sub_Grupo, observacao FROM fornecedor";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) > 0) {
    // Montagem da tabela com os campos extras
    echo "<table class='table'>
            <thead>
                <tr>
                    <th>ID Fornecedor</th>
                    <th>Razão Social</th>
                    <th>Nome Fantasia</th>
                    <th>Apelido</th>
                    <th>Grupo</th>
                    <th>Subgrupo</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>";
    
    // Exibição de cada linha com os dados adicionais
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
                <td>".htmlspecialchars($row['id_Fornecedor'])."</td>
                <td>".htmlspecialchars($row['razao_Social'])."</td>
                <td>".htmlspecialchars($row['nome_Fornecedor'])."</td>
                <td>".htmlspecialchars($row['apelido'])."</td>
                <td>".htmlspecialchars($row['grupo'])."</td>
                <td>".htmlspecialchars($row['sub_Grupo'])."</td>
                <td>".htmlspecialchars($row['observacao'])."</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "Nenhum resultado encontrado.";
}

// Fechando a conexão com o banco de dados
mysqli_close($conexao);
?>
</body>
</html>
