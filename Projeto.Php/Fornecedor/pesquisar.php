<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar as Compras</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Pesquisar Produtos Cadastrados</h1>
    <form action="" method="post">
        <label for="pesquisar">Pesquisar a razão social do fornecedor</label>
        <input type="text" name="pesquisar" id="pesquisar">
        <input type="submit" value="Pesquisar">
    </form>
<br>
    <?php
    include('conexao.php');

    // Se o campo 'pesquisar' for enviado, realiza a pesquisa
    if (isset($_POST['pesquisar']) && !empty($_POST['pesquisar'])) {
        $pesquisar = $_POST['pesquisar'];
        $pesquisar = "%$pesquisar%";
        $stmt = $conexao->prepare("SELECT id_Fornecedor, razao_Social, nome_Fornecedor, apelido, grupo, sub_Grupo, observacao FROM fornecedor WHERE razao_Social LIKE ? OR nome_Fornecedor LIKE ? OR apelido LIKE ? OR grupo LIKE ? OR sub_Grupo LIKE ?");
        $stmt->bind_param("sssss", $pesquisar, $pesquisar, $pesquisar, $pesquisar, $pesquisar);
    } else {
        // Caso contrário, exibe todos os registros
        $stmt = $conexao->prepare("SELECT id_Fornecedor, razao_Social, nome_Fornecedor, apelido, grupo, sub_Grupo, observacao FROM fornecedor");
    }

    $stmt->execute();
    $resultado = $stmt->get_result();

    if (mysqli_num_rows($resultado) > 0) {
        echo "<h2>Informações do Fornecedor</h2>";
        echo "<table class='table'><thead><tr>
                <th>ID Fornecedor</th>
                <th>Razão Social</th>
                <th>Nome do Fornecedor</th>
                <th>Apelido</th>
                <th>Grupo</th>
                <th>Sub-Grupo</th>
                <th>Observação</th>
              </tr></thead><tbody>";
        
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
        echo "<h3>Nenhum resultado encontrado.</h3>";
    }

    mysqli_close($conexao);
    ?>
</body>
</html>
