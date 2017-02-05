<?php 
		session_start();
							if(!isset($_SESSION['login']) and $_SESSION['tipo']> 0){ 
								session_destroy(); 
										header('location: index.php'); 
										echo"<script>alert('Falha de Login')";
										}
										
						$conexao = mysqli_connect('localhost','admin','123456') or die ("ERRO: ao tentar conexão");
					$banco = mysqli_select_db($conexao, 'banco') or die("ERRO: falha ao encontrar Banco de Dados");
				
				if(isset($_REQUEST['create'])){
				
				$login = $_REQUEST['login'];
				$nome = $_REQUEST['nome'];
				$senha = $_REQUEST['senha'];
				$email = $_REQUEST['email'];
				$tipo = $_REQUEST['tipo'];
				
				$sql = "INSERT INTO usuarios(login, nome, senha, email,tipo,ativo) VALUES('$login','$nome','$senha','$email','$tipo',1)";
				}
				else if(isset($_REQUEST['createmat'])){
					$nome = $_REQUEST['nome'];
					$sigla = $_REQUEST['sigla'];
					$curso = $_REQUEST['curso'];
					
					
				$sql = "INSERT INTO materias(nome, sigla, curso) VALUES('$nome','$sigla','$curso')";
				}
				
				$query = mysqli_query($conexao,$sql) or die ("A consulta falhou: ".mysqli_error($conexao)."<br/>SQL: ".$sql);
				
				
				mysqli_close($conexao);
	echo"<strong>Operação Realizada</strong></br>
				<a href='adm.php'>Retornar</a></br>";
				
						
?>
	