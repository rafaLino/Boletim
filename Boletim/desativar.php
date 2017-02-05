<?php
		
		$conexao = mysqli_connect('localhost','admin','123456') or die ("ERRO: ao tentar conexão");
			$banco = mysqli_select_db($conexao, 'banco') or die("ERRO: falha ao encontrar Banco de Dados");
		
		$des = $_REQUEST['login'];
		$troca = "UPDATE usuarios SET ativo='0' WHERE login='$des'";
		$res = mysqli_query($conexao,$troca) or die("A consulta falhou:". mysqli_error($conexao)."<br/>SQL:".$troca);
		mysqli_close($conexao);
		header('location: adm.php');
?>