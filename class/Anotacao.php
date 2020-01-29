<?php
    class Anotacao{
        
		private $pdo;
		
		public function conectar(){
			global $pdo;

			try{
				$pdo = new PDO("mysql:dbname=Notavel;host=localhost;","Notavel","admin");
			}catch(PDOException $e){
				echo "Erro: ".$e -> getMessage();
				exit();
			}catch(Exception $e){
				echo "Erro: ".$e -> getMessage();
				exit();
			}
		}

		public function anotar($usuario, $criacao, $titulo, $conteudo){
			global $pdo;

			try{

				$sql = $pdo -> prepare("INSERT INTO anotacoes(usuario_id, criacao, atualizacao, titulo, texto) VALUES(:u, :c, :a, :t, :ct)");
				$sql -> bindValue(":u", $usuario);
				$sql -> bindValue(":c", $criacao);
				$sql -> bindValue(":a", null);
				$sql -> bindValue(":t", $titulo);
				$sql -> bindValue(":ct", $conteudo);
				$sql -> execute();
				return true;

			}catch(PDOException $e){
				echo "SQL Erro: ".$e -> getMessage();

			}catch(Exception $e){
				echo "Erro: ".$e -> getMessage();
			}

		}

		public function ler($nota_id){
			global $pdo;

			$res = array();

            $sql = $pdo->prepare("SELECT * FROM anotacoes WHERE nota_id = :n");
            $sql -> bindValue(":n", $nota_id);
            $sql->execute();

            $dados = $sql->fetch(PDO::FETCH_ASSOC);
            return $dados;
		}

		public function atualizar($nota_id, $titulo, $conteudo, $atualizacao){
			global $pdo;

			$sql = $pdo->prepare("UPDATE anotacoes SET titulo = :t, texto = :ct, atualizacao = :a WHERE nota_id = :n");
			$sql -> bindValue(":n", $nota_id);
            $sql -> bindValue(":t", $titulo);
            $sql -> bindValue(":ct", $conteudo);
            $sql -> bindValue(":a", $atualizacao);
            $sql -> execute();

		}

		public function apagar($nota_id){
			global $pdo;

			$sql = $pdo -> prepare("DELETE FROM anotacoes WHERE nota_id = :n");
			$sql -> bindValue(":n", $nota_id);
			$sql -> execute();

		}

		public function listar($usuario){
			global $pdo;

			$arquivo = array();
			$sql = $pdo -> prepare("SELECT a.nota_id, a.titulo, u.usuario, a.criacao FROM anotacoes a, usuarios u WHERE a.usuario_id = :u AND a.usuario_id = u.usuario_id ORDER BY criacao DESC");
			$sql -> bindValue(":u", $usuario);
			$sql -> execute();
			
            $arquivo = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $arquivo;
		}        
	}

	$nota = new Anotacao();	
	$nota -> conectar();

?>