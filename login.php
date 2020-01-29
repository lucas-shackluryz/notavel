<html lang="pt-br">
    <head>
        <meta charset="uft-8"/>
        <link rel="shortcut icon" href="img/mini_icon.png"/>
        <link rel="stylesheet" href="css/estilo.css"/>
    </head>
    <script>
			function mostrarSenha(){
				var tipo = document.getElementById("senha");
				if(tipo.type == "password"){
					tipo.type = "text";
				}else{
					tipo.type = "password";
				}
			}
	</script>
    <body>
        <div class="wallpaper">
            <section class="login">
                <table>
                    <tr>
                        <td colspan=2 align=center>
                            <div class="logo">
                            </div>
                            <?php
                                session_start();
                                if(isset($_SESSION['msg'])){
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="log">
                                <form action="class/Usuario.php" method="post">
                                <legend>FAZER LOGIN</legend>
                                <table>
                                    <tr>
                                        <td><label for="usuario">Usuario:</label></td><td><input type="text" name="usuario" placeholder="Digite seu nome de usuário" size=20 maxlength=15 required></td>
                                    </tr>
                                    <tr>
                                        <td><label for="senha">Senha:</label></td><td><input type="password" name="senha" placeholder="Digite sua senha" size=20 maxlength=15 required></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2 align=center><button type="submit" name="login" value=true>Acessar</button></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2 align=center>
                                            <a href= "recuperarSenha.php">Esqueci minha senha</a>
                                        </td>
                                    </tr>
                                </table> 
                                </form>
                            </div>
                        </td>
                        <td>
                            <div class="log">
                                <form action="class/Usuario.php" method="post">
                                <legend>CADASTRAR-SE</legend>
                                <table>
                                    <tr>
                                        <td><label for="nome">Nome:</label></td><td><input type="text" name="nome" placeholder="Me fala seu nome completo..." size=20 maxlength=45 required></td>
                                    </tr>
                                    <tr>
                                        <td><label for="email">E-mail:</label></td><td><input type="email" name="email" placeholder="Você tem e-mail?..." size=20 maxlength=60 required></td>
                                    </tr>
                                    <tr>
                                        <td><label for="usuario">Usuario:</label></td><td><input type="text" name="usuario" placeholder="Pensa num codinome massa..." size=20 maxlength=15 required></td>
                                    </tr>
                                    <tr>
                                        <td><label for="senha">Senha:</label></td><td><input type="password" id="senha" name="senha" placeholder="Seja Criativo!..." size=13 maxlength=14 required><button type="button" onclick="mostrarSenha()">õ.O</button></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2 align=center><button type="submit" name="enviar" value=true>Cadastrar</td>
                                    </tr>
                                </table>
                                </form>
                            </div>
                        </td>
                    </tr>
                </table>
            </section>
        </div>  
    </body>
</html>