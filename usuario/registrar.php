<?php
    require_once("../../conexao/conexao.php");
?>
<?php
    $estados = "SELECT *
                FROM
                    estados";
    $con_estados = mysqli_query($conectar, $estados);

    if(isset($_POST["usuario"])) {
        $usuario = $_POST["usuario"];
        $senha =  $_POST["senha"];
        $nomecompleto = $_POST["nomecompleto"];
        $ddd = $_POST["ddd"];
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];
        $estadoID = $_POST["estado"];
        $cidade = $_POST["cidade"];
        $cep = $_POST["cep"];
        $endereco = $_POST["endereco"];
        $numero = $_POST["numero"];
        $complemento = $_POST["complemento"];
        $cliente = "INSERT INTO 
                        `clientes` (`clienteID`, `nomecompleto`, `endereco`, `complemento`, `numero`, `cidade`, `estadoID`, `cep`, `ddd`, `telefone`, `email`, `usuario`, `senha`, `nivel`) 
                    VALUES 
                        (NULL, '$nomecompleto', '$endereco', '$complemento', '$numero', '$cidade', '$estadoID', '$cep', '$ddd', '$telefone', '$email', '$usuario', '$senha', 'user')";
        $con_cliente = mysqli_query($conectar, $cliente);
        if(!$con_cliente) {
            die("Erro ao conectar com o banco de dados");
        } else {
            header("location: login.php");
        }
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
    <link rel="stylesheet" href="../_css/registrar.css">
</head>
<body>
    <?php
        include_once("../_incluir/topo.php");
    ?>
    <main>
        <div id="janela_registrar">
            <form action="registrar.php" method="post">
                <input type="text" name="usuario" id="usuario" placeholder="Usuario">
                <input type="password" name="senha" id="senha" placeholder="Senha">
                <input type="text" name="nomecompleto" id="nomecompleto" placeholder="Nome completo">
                <input type="text" name="ddd" id="ddd" placeholder="DDD">
                <input type="text" name="telefone" id="telefone" placeholder="Telefone">
                <input type="text" name="email" id="email" placeholder="Email">
                <select name="estado" id="estado">
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
                <input type="text" name="cidade" id="cidade" placeholder="Cidade">
                <input type="text" name="cep" id="cep" placeholder="CEP">
                <input type="text" name="endereco" id="endereco" placeholder="Endereço">
                <input type="text" name="numero" id="numero" placeholder="Numero">
                <input type="text" name="complemento" id="complemento" placeholder="Complemento">
                <input type="submit" name="registrar" id="registrar" value="Registrar">
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