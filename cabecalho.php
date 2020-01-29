<html lang="pt-br">
    <head>
        <meta charset="uft-8"/>
        <link rel="shortcut icon" href="img/mini_icon.png"/>
        <link rel="stylesheet" href="css/estilo.css"/>
    </head>
    <body>
        <div class="tema">
        <header class="cabecalho">   
            <div class="id">
                <?php echo "Bem Vindo(a), ".$_SESSION['usuario']; ?>
                <a href="logout.php">Sair</a>
            </div>
        </header>
