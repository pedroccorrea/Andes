<?php
    require_once("../conexao/conexao.php");
    session_start();
?>
<?php
    if(!$_SESSION["user"]) {
        header("location: login.php");
    }

    $produtos = "SELECT 
                    produtoID, nomeproduto, precounitario, tempoentrega, imagempequena
                FROM
                    produtos ";
    if(isset($_GET["pesquisa"])){
        $pesquisa = $_GET["pesquisa"];
        $produtos .= " WHERE nomeproduto LIKE '%{$pesquisa}%' ";
    }

    $con_produtos = mysqli_query($conectar, $produtos);
    if(!$con_produtos) {
        die("Falha ao conectar com o banco de dados.");
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
    <link rel="stylesheet" href="_css/produtos.css">
</head>
<body>
    <?php
        include_once("_incluir/topo.php");
    ?>

    <main>
        <div id="janela_pesquisa">
            <form action="listagem.php" method="get">
                <input type="text" id="pesquisa" name="pesquisa">
                <input type="image" id="pesquisar" name="pesquisar" src="_assets/botao_search.png">
            </form>
        </div>
        <div id="listagem_produtos">
            <?php
                while($linha = mysqli_fetch_assoc($con_produtos)) {
            ?>
                    <ul>
                        <li class="imagem">
                            <a href="detalhe.php?codigo=<?php echo $linha["produtoID"] ?>">
                                <img src="<?php echo $linha["imagempequena"] ?>" alt="Imagem ilustrativa">
                            </a>
                        </li>
                        <li><h3><?php echo $linha["nomeproduto"] ?></h3></li>
                        <li>Preço unitário: <strong><?php echo $linha["precounitario"] ?></strong></li>
                        <li>Tempo de entrega: <strong><?php echo $linha["tempoentrega"] ?> dias</strong></li>
                    </ul>
            <?php
                }
            ?>
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