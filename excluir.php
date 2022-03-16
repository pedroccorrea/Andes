<?php
    require_once("../conexao/conexao.php");
?>
<?php
    //Excluir da tabela "transportadoras"
    if(isset($_POST["excluir"])){
        $_transID = $_POST["transportadoraID"];
        $_trans = "DELETE FROM transportadoras WHERE transportadoraID = {$_transID}";
        $del_trans = mysqli_query($conectar, $_trans);
        if(!$del_trans) {
            die("Erro ao se conectar com o banco de dados.");
        }
    }

    //Consultar a tabela "transportadoras"
    if(isset($_GET["codigo"])) {
        $transID = $_GET["codigo"];
    } else {
        header("location: transportadoras.php");
    }
    $trans = "SELECT *
            FROM
                transportadoras
            WHERE
                transportadoraID = {$transID}";
    $con_trans = mysqli_query($conectar, $trans);
    $con_trans = mysqli_fetch_assoc($con_trans);
    if(!$con_trans) {
        die("Erro ao conectar com o banco de dados.");
    }

    $nome = $con_trans["nometransportadora"];
    $endereco = $con_trans["endereco"];
    $cidade =   $con_trans["cidade"];
    $cnpj = $con_trans["cnpj"];
    $transportadoraID = $con_trans["transportadoraID"];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Andes</title>
    <link rel="stylesheet" href="_css/style.css">
    <link rel="stylesheet" href="_css/alterar.css">
</head>
<body>
    <?php
        include_once("_incluir/topo.php");
    ?>
    <main>
        <div id="janela_alteracao">
            <form action="excluir.php" method="post">
                <label for="nometransportadora">Nome da Transportadora</label>
                <input type="text" name="nometransportadora" id="nometransportadora" value="<?php echo $nome ?>">

                <label for="endereco">Endereço</label>
                <input type="text" name="endereco" id="endereco" value="<?php echo $endereco ?>">

                <label for="cidade">Cidade</label>
                <input type="text" name="cidade" id="cidade" value="<?php echo $cidade ?>">

                <label for="cnpj">CNPJ</label>
                <input type="text" name="cnpj" id="cnpj" value="<?php echo $cnpj ?>">

                <input type="hidden" name="transportadoraID" id="transportadoraID" value="<?php echo $transportadoraID ?>">
                <input type="submit" name="excluir" id="excluir" value="Confirmar exclusão">
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