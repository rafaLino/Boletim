<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Instituição</title>
		<link rel="icon" href="imagem/icon.ico" type="image/x-icon">
		<meta charset="UTF-8">
		<meta name="viewport" content="width= devide-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="css/style.css" type="text/css" rel="stylesheet" />
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>

<body>
	<div class="container">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick=location.href="prof.php">&times;</span></button>
						<h4 class="modal-title text-center">Faltas</h4>
				</div>
				 <form class="inline text-center" action="" method="POST">
					<input type="number" name="nota"   min="0" step=" 0.01" class="text-center">
						<div class="modal-footer">
							<button type="submit" name="save" class="btn btn-default">Salvar</button>
						</div>
				</form>
			</div>
		</div>
	</div>
					
</body>
</html>

<?php
		
		if(isset($_REQUEST['nota'])){	
		
		$id= $_REQUEST['falta'];
		$nota = $_REQUEST['nota'];		
		
		$conexao = mysqli_connect('localhost','admin','123456') or die("ERRO: sem conexão.");
					$banco = mysqli_select_db($conexao,'banco') or die("ERRO: Não foi possível selecionar o BD.");
		
		$res = "UPDATE notas SET faltas='$nota' WHERE id='$id' ";
				
				$query = mysqli_query($conexao,$res) or die("A Alteração falhou: ".mysqli_error($conexao)."<br/>SQL: ".$res);
					
					mysqli_close($conexao);
			
				header('location: prof.php');
			}
?>

