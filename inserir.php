<?php
    require_once("../conexao/conexao.php");
?>
<?php
    if(isset($_POST["nometransportadora"])) {
        $nometransportadora = $_POST["nometransportadora"];
        $endereco = $_POST["endereco"];
        $telefone = $_POST["telefone"];
        $cidade = $_POST["cidade"];
        $estadoID = $_POST["estados"];
        $cep = $_POST["cep"];
        $cnpj = $_POST["cnpj"];

        $trans = "INSERT INTO
                    transportadoras(nometransportadora, endereco, telefone, cidade, estadoID, cep, cnpj)
                VALUES('$nometransportadora', '$endereco', '$telefone', '$cidade', $estadoID, '$cep', '$cnpj')";
        $con_trans = mysqli_query($conectar, $trans);
        if(!$con_trans) {
            die("Erro ao se conectar com o banco de dados.");
        } else {
            header("location: inserir.php");
        }
    }

    //Consulta a tabela "estados"
    $estados = "SELECT *
                FROM
                    estados";
    $con_estados = mysqli_query($conectar, $estados);
    if(!$estados) {
        die("Erro ao se conectar com o banco de dados.");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Andes</title>
    <link rel="stylesheet" href="_css/style.css">
    <link rel="stylesheet" href="_css/inserir.css">
</head>
<body>
    <?php
        include_once("_incluir/topo.php");
    ?>

    <main>
        <div id="janela_inserir">
            <form action="inserir.php" method="post">
                <input type="text" name="nometransportadora" id="nometransportadora" placeholder="Nome da Transportadora">

                <input type="text" name="endereco" id="endereco" placeholder="Endereço">

                <input type="text" name="telefone" id="telefone" placeholder="Telefone">

                <input type="text" name="cidade" id="cidade" placeholder="Cidade">

                <select name="estados" id="estados">
                    <option value="" selected hidden disabled>-- Selecione seu estado --</option>
                    <?php
                        while($linha = mysqli_fetch_assoc($con_estados)) {
                    ?>
                            <option value="<?php echo $linha["estadoID"] ?>">
                                <?php echo $linha["nome"] ?>
                            </option>
                    <?php
                        }
                    ?>
                </select>

                <input type="text" name="cep" id="cep" placeholder="CEP">

                <input type="text" name="cnpj" id="cnpj" placeholder="CNPJ">

                <input type="submit" name="enviar" id="enviar" value="Enviar">
            </form>
        </div>
    </main>

    <?php
        include_once("_incluir/footer.php");
    ?>
</body>
</html>

<?php
    mysqli_close($conectar);
?>