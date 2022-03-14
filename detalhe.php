<?php
    require_once("../conexao/conexao.php");
?>
<?php
    if($_GET["codigo"]) {
        $produtoID = $_GET["codigo"];
    }
    $produtos = "SELECT *
                FROM
                    produtos
                WHERE
                    produtoID = {$produtoID}";
    $con_produtos = mysqli_query($conectar, $produtos);
    if(!$con_produtos) {
        die("Erro ao conectar com o banco de dados");
    }
    
    $detalhe_produto = mysqli_fetch_assoc($con_produtos);

    $imagemgrande = $detalhe_produto["imagemgrande"];
    $nomeproduto = $detalhe_produto["nomeproduto"];
    $descricao = $detalhe_produto["descricao"];
    $codigobarra = $detalhe_produto["codigobarra"];
    $tempoentrega = $detalhe_produto["tempoentrega"];
    $precorevenda = $detalhe_produto["precorevenda"];
    $precounitario = $detalhe_produto["precounitario"];
    $estoque = $detalhe_produto["estoque"];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Andes</title>
    <link rel="stylesheet" href="_css/style.css">
    <link rel="stylesheet" href="_css/produto_detalhe.css">
</head>
<body>
    <?php
        include_once("_incluir/topo.php");
        include_once("_incluir/funcoes.php");
    ?>

    <main>
        <div id="produto_detalhe">
            <ul>
                <li>
                    <img src="<?php echo $imagemgrande ?>" alt="imagem ilustrativa">
                </li>
                <li><h2><?php echo $nomeproduto ?></h2></li>
                <li><?php echo $descricao ?></li>
                <li>Código de barras: <strong><?php echo $codigobarra ?></strong></li>
                <li>Tempo de entrega estimado: <strong><?php echo $tempoentrega ?> dias</strong></li>
                <li>Preço de revenda: <strong><?php echo real_format($precorevenda) ?></strong></li>
                <li>Preço unitário: <strong><?php echo real_format($precounitario) ?></strong></li>
                <li>Em estoque: <strong><?php echo $estoque ?> unidades</strong></li>
            </ul>
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