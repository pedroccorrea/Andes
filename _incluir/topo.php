<header>
    <div id="header_central">
        <?php
            if(isset($_SESSION["user"])) {
                $clienteID = $_SESSION["user"];
                $saudacao = "SELECT
                                nomecompleto
                            FROM
                                clientes
                            WHERE
                                clienteID = {$clienteID}";
                $saudacao = mysqli_query($conectar, $saudacao);
                if(!$saudacao) {
                    die("Erro ao conectar com o banco de dados.");
                }
                $saudacao_login = mysqli_fetch_assoc($saudacao);
                $nome_cliente = $saudacao_login["nomecompleto"];
        ?>
                <div id="header_saudacao">
                    <p>Bem vindo, <?php echo $nome_cliente ?> ! - <a href="logout.php">Sair</a></p>

                </div>
        <?php
            }
        ?>
        <a href="index.php" target="_self" rel="_prev">
            <img src="_assets/logo_andes.gif">
        </a>
        <img src="_assets/text_bnwcoffee.gif" alt="">
    </div>
</header>