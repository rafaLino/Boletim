<?php 
			session_start();
							if(!isset($_SESSION['login'])){ 
								session_destroy(); 
										header('location: index.php'); 
										echo"<script>alert('Falha de Login')";
										}
			
		
			
			$conexao = mysqli_connect('localhost','admin','123456') or die ("ERRO: ao tentar conexão");
					$banco = mysqli_select_db($conexao, 'banco') or die("ERRO: falha ao encontrar Banco de Dados");
		if(isset($_REQUEST['login'])){
			$login = $_REQUEST['login'];
			$sql = "DELETE FROM usuarios WHERE login='$login'";
			
		}
		else if(isset($_REQUEST['id'])){
			$id = $_REQUEST['id'];
			$sql = "DELETE FROM materias WHERE id='$id'";
			
		}
		$query = mysqli_query($conexao,$sql) or die("A Exclusão falhou: ".mysqli_error($conexao)."<br/>SQL: ".$sql);
		mysqli_close($conexao);
		echo"<strong>Exclusão Realizada</strong></br>
				<a href='adm.php'>Retornar</a></br>";
?>