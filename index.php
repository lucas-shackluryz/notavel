<?php
	session_start();
	if(!isset($_SESSION['usuario_id'])){
		header("location: login.php");
		exit;
	}
	require_once('cabecalho.php');
?>
		<section class="principal">
			<div class="arquivo">
				<?php 
					include_once('class/Anotacao.php');
					$usuario = $_SESSION['usuario_id'];
					
					$arquivo = $nota->listar($usuario);			
				?>
				<table style="width:100%">
					<tr id="indice">
						<td style="min-width:180px">Título</td>
						<td style="min-width:80px">Autor</td>
						<td style="min-width:100px">Data</td>
						<td style="min-width:120px"></td>
					</tr>
            		<?php
					if(count($arquivo) > 0) {
						for($i=0; $i < count($arquivo); $i++) {
							echo "<tr>";
							foreach($arquivo[$i] as $k => $v) {
								if($k != "nota_id"){
									if($k == "criacao"){
										echo "<td>".date('d/m/Y', strtotime($v))."</td>";
									}else{
										echo "<td>".$v."</td>";
									}
								}
							}
							?>
								<td align=center>
									<a href="index.php?nota_up=<?php echo $arquivo[$i]['nota_id']; ?>" style="color: white; margin-right: 10px;">Editar</a>
									<a href="index.php?nota_id=<?php echo $arquivo[$i]['nota_id']; ?>" style="color: white;">Excluir</a>
								</td>
							<?php
							echo "</tr>";	
						}  
					}
					?>
				</table>
			</div>
			<div class="perfil">
			</div>
			<?php
				if(isset($_GET['nota_up'])){
					$nota_id = addslashes($_GET['nota_up']);
					$dados = $nota->ler($nota_id); 
				}

				if(isset($_POST['editar'])){

					$nota_id = addslashes($_GET['nota_up']);
					$titulo = addslashes($_POST['nome']);
					$conteudo = addslashes($_POST['conteudo']);
					$atualizacao = date('Y-m-d');
	
					$nota->atualizar($nota_id, $titulo, $conteudo, $atualizacao);
					header("Location: index.php");
	
				}elseif(isset($_POST['salvar'])){

					$usuario = $_SESSION['usuario_id'];
					$criacao = date('Y-m-d');
					$titulo = $_POST['nome'];
					$conteudo = $_POST['conteudo'];
					
					if($nota -> anotar($usuario, $criacao, $titulo, $conteudo)){
						header("Location: index.php");
					}
				}
			?>
			<div class="editor">
				<form method="post">
				<table>
					<tr>
						<td><label for="titulo">Título:</label></td><td align=right><input id="titulo" type="text" name="nome" size=56 value="<?php if(isset($dados)){echo $dados['titulo'];} ?>" required></td>
					<tr>
						<td colspan=2><textarea id="anotacao" name="conteudo" rows="20" cols="65" placeholder="Click aqui para redigir um texto" maxlength=10000 required><?php if(isset($dados)){echo $dados['texto'];} ?></textarea></td>
					</tr>
					<tr>
						<td colspan=2 align=center><button type=submit name="<?php if(isset($dados)){echo "editar";}else{echo "salvar";} ?>"><?php if(isset($dados)){echo "Editar";}else{echo "Salvar";} ?></button></td>
					</tr>
				</table>
				</form>
			</div>
		</section>
<?php
    if(isset($_GET['nota_id'])){
		$nota_id = addslashes($_GET['nota_id']);
		
        $nota->apagar($nota_id);
        header("location: index.php");
    }
?>
<?php 
	require_once('rodape.php');
?>
