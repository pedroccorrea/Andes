<?php
    require_once("../../conexao/conexao.php");
    session_start();
?>
<?php
    if(!$_SESSION["user"]) {
        header("location: ../usuario/login.php");
    }

    $trans = "SELECT *
            FROM
                transportadoras";
    $con_trans = mysqli_query($conectar, $trans);
    if(!$con_trans) {
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
    <link rel="stylesheet" href="../_css/transportadoras.css">
</head>
<body>
    <?php
        include_once("../_incluir/topo.php");
    ?>

    <main>
        <div id="janela_transportadoras">
            <?php
                while($linha = mysqli_fetch_assoc($con_trans)) {
            ?>
                <ul>
                    <li><?php echo  $linha["nometransportadora"] ?></li>
                    <li><?php echo $linha["cidade"] ?></li>
                    <li><a href="alterar.php?codigo=<?php echo $linha["transportadoraID"] ?>">Alterar</a></li>
                    <li><a href="excluir.php?codigo=<?php echo $linha["transportadoraID"] ?>">Excluir</a></li>
                </ul>
            <?php
                }
            ?>
        </div>
        <div id="nova">
            <a href="inserir.php">Nova transportadora</a>
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