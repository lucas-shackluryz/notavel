<?php
	Class Usuario{

		private $pdo;
		
		public function conectar(){
			global $pdo;

			try{
				$pdo = new PDO("mysql:dbname=Notavel;host=localhost;","Notavel","admin");
			}catch(PDOException $e){
				echo "Erro: ".$e -> getMessage();
			}catch(Exception $e){
				echo "Erro: ".$e -> getMessage();
			}
		}

		public function cadastrar($nome, $email, $usuario, $senha){
			global $pdo;

			$sql = $pdo -> prepare("SELECT usuario_id FROM usuarios WHERE email = :e");
			$sql -> bindValue(":e", $email);
			$sql -> execute();
			
			if($sql -> rowCount() >0){
				session_start();
				$_SESSION['msg'] = "<b>Foi mal, esse e-mail já tá cadastrado.</b>";
				header("Location: ../login.php");

			}else{
				$sql = $pdo -> prepare("INSERT INTO usuarios(nome, email, usuario, senha) VALUES (:n, :e, :u, :s)");
				$sql -> bindValue(":n", $nome);
				$sql -> bindValue(":e", $email);
				$sql -> bindValue(":u", $usuario);
				$sql -> bindValue(":s", md5($senha));
				$sql -> execute();
				return true;
			}
		}

		public function logar($usuario, $senha){
			global $pdo;

			$sql = $pdo->prepare("SELECT usuario_id, usuario FROM usuarios WHERE usuario = :u AND senha = :s");
			$sql -> bindValue(":u", $usuario);
			$sql -> bindValue(":s", md5($senha));
			$sql -> execute();

			if($sql -> rowCount() > 0){
				$dado = $sql->fetch();
				session_start();
				$_SESSION['usuario_id'] = $dado['usuario_id'];
				$_SESSION['usuario'] = $dado['usuario'];
				return true;
			}else{
				session_start();
				$_SESSION['msg'] = "<b>Acho que você errou a senha ou seu nome de usuário.</b>";
				header("Location: ../login.php");
			}
		}
	}
/*----------------------------------------------------------------------------------------*/
	if(isset($_POST['enviar'])){
		$nome = addslashes($_POST['nome']);
		$email = addslashes($_POST['email']);
		$usuario = addslashes($_POST['usuario']);
		$senha = addslashes($_POST['senha']);

		$u = new Usuario();
		$u -> conectar();

		
		if($u -> cadastrar($nome, $email, $usuario, $senha)){
			session_start();
			$_SESSION['msg'] = "<b>Você foi cadastrado com sucesso! Agora já da pra logar.</b>";
			header("Location: ../login.php");
		}

	}else if(isset($_POST['login'])){
		$usuario = addslashes($_POST['usuario']);
		$senha = addslashes($_POST['senha']);

		$u = new Usuario;
		$u -> conectar();

		if($u -> logar($usuario, $senha)){
			header("location: ../index.php");
		}

	}
	
?>