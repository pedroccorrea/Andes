<?php
    require_once("../conexao/conexao.php");
    session_start()
?>
<?php
    if(isset($_POST["usuario"])) {
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];
        $cliente = "SELECT *
                    FROM
                        clientes
                    WHERE
                        usuario = '{$usuario}' and senha = '{$senha}'";
        $con_cliente = mysqli_query($conectar, $cliente);
        if(!$con_cliente) {
            die("Falaha ao conectar com o banco de dados.");
        }
        $login = mysqli_fetch_assoc($con_cliente);
        if(empty($login)) {
            $mensagem = "Login sem sucesso.";
        } else {
            $_SESSION["user"] = $login["clienteID"];
            header("location: listagem.php");
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
    <link rel="stylesheet" href="_css/style.css">
</head>
<body>
    <?php
        include_once("_incluir/topo.php");
    ?>
    <main>
        <div id="janela_login">
            <form action="login.php" method="post">
                <h2>Tela de Login</h2>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario">
                <input type="password" name="senha" id="senha" placeholder="Senha">
                <input type="submit" name="login" id="login" value="Login">

                <?php 
                    if(isset($mensagem)){
                ?>
                    <p><?php echo $mensagem ?></p>
                <?php
                    }
                ?>
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