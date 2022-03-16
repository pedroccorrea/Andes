<?php
    require_once("../../conexao/conexao.php");
    session_start();
?>
<?php
    //Realizar alteração na tabela "transportadoras"
    if(isset($_POST["alterar"])) {
        $_transportadoraID = $_POST["transportadoraID"];
        $_nome =  $_POST["nometransportadora"];
        $_endereco = $_POST["endereco"];
        $_cidade = $_POST["cidade"];
        $_estado = $_POST["estados"];
        $_cep = $_POST["cep"];
        $_telefone = $_POST["telefone"];
        $_cnpj = $_POST["cnpj"];
        $_trans = "UPDATE
                            transportadoras
                        SET
                            nometransportadora  = '{$_nome}',
                            endereco = '{$_endereco}',
                            cidade = '{$_cidade}', 
                            estadoID = '{$_estado}', 
                            cep = '{$_cep}', 
                            telefone = '{$_telefone}', 
                            cnpj = '{$_cnpj}' 
                        WHERE
                            transportadoraID = {$_transportadoraID}";
        $_con_trans = mysqli_query($conectar, $_trans);
        if(!$_con_trans) {
            die("Erro ao conectar com o banco de dados.");
        }
    }

    //Consulta a tabela "transportadoras"
    if(isset($_GET["codigo"])){
        $trans_id = $_GET["codigo"];
    } else {
        Header("location: index.php");
    }
    $trans = "SELECT *
            FROM
                transportadoras
            WHERE transportadoraID = {$trans_id}";
    $con_trans = mysqli_query($conectar, $trans);
    $con_trans = mysqli_fetch_assoc($con_trans);

    $nome = $con_trans["nometransportadora"];
    $endereco = $con_trans["endereco"];
    $cidade = $con_trans["cidade"];
    $cep = $con_trans["cep"];
    $telefone = $con_trans["telefone"];
    $cnpj = $con_trans["cnpj"];
    $estadoID = $con_trans["estadoID"];
    $transportadoraID = $con_trans["transportadoraID"];

    //Consulta a tabela "estados"
    $estados = "SELECT *
                FROM
                    estados";
    $con_estados = mysqli_query($conectar, $estados);
    if(!$con_estados) {
        die("Erro ao conectar com o banco de dados.");
    }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Andes</title>
    <link rel="stylesheet" href="../_css/style.css">
    <link rel="stylesheet" href="../_css/alterar.css">
</head>
<body>
    <?php
        include_once("../_incluir/topo.php");
    ?>
    <main>
        <div id="janela_alteracao">
            <form action="alteracao.php" method="post">
                <h2>Alteração de Transportadora</h2>

                <label for="nometransportadora">Nome da Transportadora</label>
                <input type="text" id="nometransportadora" name="nometransportadora" value="<?php echo $nome ?>">

                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" value="<?php echo $endereco ?>">

                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" value="<?php echo $cidade ?>">

                <label for="estados">Estados</label>
                <select name="estados" id="estados">
                    <?php
                        while($linha = mysqli_fetch_assoc($con_estados)) {
                    ?>
                        <option value="<?php $linha["estadoID"] ?>" <?php echo $linha["estadoID"] == $estadoID? "selected": ""; ?>>
                            <?php echo $linha["nome"] ?>
                        </option>
                    <?php
                        }
                    ?>
                </select>

                <label for="cep">CEP</label>
                <input type="text" name="cep" id="cep" value="<?php echo $cep ?>">

                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" value="<?php echo $telefone ?>">

                <label for="cnpj">CNPJ</label>
                <input type="text" name="cnpj" id="cnpj" value="<?php echo $cnpj ?>">
                
                <input type="hidden" name="transportadoraID" value="<?php echo $transportadoraID ?>">
                <input type="submit" name="alterar" value="Confirmar alteração">
            </form>
        </div>
    </main>

    <?php
        include_once("../_incluir/footer.php");
    ?>
</body>
</html>

<?php
    mysqli_close($conectar);
?>