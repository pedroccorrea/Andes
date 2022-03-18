<?php
    require_once("../../conexao/conexao.php");
    include_once("../_incluir/funcoes.php");
?>
<?php
    if(isset($_POST["nomeproduto"])) {
        $resultado1 = publicar($_FILES["imagemgrande"]);
        $resultado2 = publicar($_FILES["imagempequena"]);
        
        $mensagem1 = $resultado1[0];
        $mensagem2 = $resultado2[0];

        $nomeproduto =      $_POST["nomeproduto"];
        $codigobarra =      $_POST["codigobarra"];
        $tempoentrega =     $_POST["tempoentrega"];
        $categoriaID =      $_POST["categoriaID"];
        $fornecedorID =     $_POST["fornecedorID"];
        $precorevenda =     $_POST["precorevenda"];
        $precounitario =    $_POST["precounitario"];
        $estoque =          $_POST["estoque"];
        $imagemgrande = $resultado1[1];
        $imagempequena = $resultado2[1];

        print_r($resultado1[1]);
        echo $imagempequena;
        
        $produto = "INSERT INTO
                        produtos(nomeproduto, codigobarra, tempoentrega, categoriaID,fornecedorID, precorevenda, precounitario, estoque, imagemgrande, imagempequena)
                    VALUES
                        ('$nomeproduto', '$codigobarra', '$tempoentrega', '$categoriaID', '$fornecedorID', '$precorevenda', '$precounitario', '$estoque', '$imagemgrande', '$imagempequena')";
        $con_produto = mysqli_query($conectar, $produto);
        if(!$con_produto) {
            die("Erro ao conectar com o banco de dados.");
        } else {
            $mensagem ="Insersão ocorreu com sucesso.";
        }
    }

    //Consultar categorias
    $categoria = "SELECT *
                FROM
                    categorias";
    $con_categoria = mysqli_query($conectar, $categoria);
    if(!$con_categoria) {
        die("Erro ao conectar com o banco de dados.");
    }

    //Consultar fornecedores
    $fornecedor = "SELECT *
                FROM
                    fornecedores";
    $con_fornecedor = mysqli_query($conectar, $fornecedor);
    if(!$con_fornecedor) {
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
    <link rel="stylesheet" href="../_css/novo_produto.css">
</head>
<body>
    <?php
        include_once("../_incluir/topo.php");
    ?>
    <main>
        <div id="novo_produto">
            <form action="novo.php" method="post" enctype="multipart/form-data">
                <h2>Incluir Novo Produto</h2>
                <input type="text" name="nomeproduto" id="nomeproduto" placeholder="Nome do Produto">
                <input type="text" name="codigobarra" id="codigobarra" placeholder="Código de Barra">

                <label for="tempoentrega">Tempo de Entrega</label>
                <input type="radio" name="tempoentrega"> 5  dias
                <input type="radio" name="tempoentrega"> 8 dias
                <input type="radio" name="tempoentrega"> 15 dias
                <input type="radio" name="tempoentrega"> 30 dias
                
                <label for="categoriaID">Selecione a categoria do produto</label>
                <select name="categoriaID" id="categoriaID">
                    <option value="" selected hidden disabled> -- Selecione -- </option>
                    <?php
                        while($linha = mysqli_fetch_assoc($con_categoria)) {
                    ?>
                            <option value="<?php echo $linha["categoriaID"] ?>">
                                <?php
                                    echo $linha["nomecategoria"]
                                ?>
                            </option>
                    <?php
                        }
                    ?>
                </select>
                
                <label for="fornecedorID">Selecione o fornecedor do produto</label>
                <select name="fornecedorID" id="fornecedorID">
                    <option value="" selected hidden disabled> -- Selecione -- </option>
                    <?php
                        while($linha = mysqli_fetch_assoc($con_fornecedor)) {
                    ?>
                            <option value="<?php echo $linha["fornecedorID"] ?>">
                                <?php
                                    echo $linha["nomefornecedor"]
                                ?>
                            </option>
                    <?php
                        }
                    ?>
                </select>

                <input type="text" name="precorevenda" id="precorevenda" placeholder="Preço Revenda">
                <input type="text" name="precounitario" id="precounitario" placeholder="Preço Unitário">
                
                <input type="hidden" name="MAX_FILE_SIZE" value="691440">
                <label for="imagemgrande">Foto Grande</label>
                <input type="file" name="imagemgrande">
                <span class="resposta">
                    <?php
                        if(isset($mensagem1)) {
                            echo $mensagem1;
                        }
                    ?>
                </span>
                <label for="imagempequena">Foto Pequena</label>
                <input type="file" name="imagempequena">
                <span class="resposta">
                    <?php
                        if(isset($mensagem2)) {
                            echo $mensagem2;
                        }
                    ?>
                </span>
                
                <input type="hidden" name="estoque" id="estoque" value="0">
                <input type="submit" name="inserir" id="inserir" value="Inserir novo produto">

                <?php
                    if(isset($mensagem)) {
                        echo "<p>" . $mensagem . "</p";
                    }
                ?>
            </form>
        </div>
    </main>
    <?php
        include_once("../_incluir/footer.php")
    ?>
</body>
</html>

<?php
    mysqli_free_result($con_categoria);
    mysqli_free_result($con_fornecedor);
    mysqli_close($conectar);
?>