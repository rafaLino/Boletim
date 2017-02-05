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
	<header>
		<?php session_start(); if(!isset($_SESSION['login'])){ session_destroy(); header('location: index.php'); echo"<script>alert('Falha de Login')";} ?>
		<h2 class="text-center">Bem-vindo  <?php echo $_SESSION['login']; ?> </h2>
<div class="container-fluid">	
	<div class="row">
		<div class="col-md-6">
			<ul class="nav nav-pills">
				<li role="presentation"><a data-toggle="modal" data-target="#myModal" class="btn btn-default" id="altersenhaaluno">Alterar Senha</a></li>
			</ul>
		</div>
		<div class="col-md-4">
			<form action="" method="POST">
				<input type="submit" name="logout" value="Sair" id="logoutaluno" class="btn btn-default" />
			</form>				  
			<?php  if(isset($_REQUEST['logout'])){ session_start(); session_destroy(); header("Location: index.php"); exit; } ?>
		</div>
	</div>
</div>
	</header>	

		<?php 
			
			$login = $_SESSION['login'];
			$conexao = mysqli_connect('localhost','admin','123456') or die ("ERRO: ao tentar conexão");
			$banco = mysqli_select_db($conexao, 'banco') or die("ERRO: falha ao encontrar Banco de Dados");
			$sql = "SELECT  materias.nome,notas.p1,notas.p2,notas.faltas FROM  materias,notas WHERE materias.id=id_materia AND id_usuario ='$login'";
			$res = mysqli_query($conexao,$sql) or die("A consulta falhou:". mysqli_error($conexao)."<br/>SQL:".$sql);					
						
		?>
						
						
<div class="container" id="tbaluno">
	<table class='table' border="2" >
		<tr>
			<td><b>Disciplina</b></b></td>
			<td><b>Prova1</b></td>
			<td><b>Prova2</b></td>
			<td><b>Faltas</b></td>
			<td><b>Media</b></td>
		</tr>
			<?php while($campo = mysqli_fetch_array($res)){
					$media = ($campo['p1']+$campo['p2'])/2;
					echo"<tr><td>".utf8_encode($campo['nome'])."</td><td>".$campo['p1']."</td><td>".$campo['p2']."</td>
					<td>".$campo['faltas']."</td><td>".$media."</td></tr>"; 
				} 
			?>
	</table></br>
</div>

							
	<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">

      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title text-center" id="myModalLabel">Alterar Senha</h4>
      		</div>

  			<form class="form-inline" action="" method="POST">
				<div class="modal-body">
					<label>Digite a Senha Atual <input class="form-control text-center" id="inline1" type="text" name="senhaantiga"></label>
					<label>Nova Senha   <input class="form-control text-center" id="inline2" type="text" name="senhanova"></label>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar Alterações</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
				
			</form>
		</div>
	</div>
</div>


<div class="container-fluid">
	<h4><font color="337ab7">ARQUIVOS</font></h4>
	<hr style="margin-bottom: 0px">
	<div class="row">
		<div class="col-md-12" id="containerprof">
			<div class="panel-group" id="panel-1">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-56026" href="#panel-element-1"><span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" ></span></a> <b>como derrotar destruidor</b>  
					</div>
					<div id="panel-element-1" class="panel-collapse collapse">
						<div class="panel-body">
						<a href="#"> Arquivo 1 </a> 
						</div>
						<div class="panel-body">
						<a href="#"> Arquivo 2 </a> 
						</div>
						<div class="panel-body">
						<a href="#"> Arquivo 3 </a> 
						</div>
						<div class="panel-body">
						<a href="#"> Arquivo 4 </a> 
						</div>
					</div>
					<div class="panel-heading">
						<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-56026" href="#panel-element-2"> <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" ></span></a> <b>derrotar vilão I</b>
					</div>
					
					<div id="panel-element-2" class="panel-collapse collapse">
						<div class="panel-body">
							<a href="#"> Arquivo 1 </a>
						</div>
						<div class="panel-body">
							<a href="#"> Arquivo 2 </a>
						</div>
						<div class="panel-body">
							<a href="#"> Arquivo 3 </a>
						</div>
					</div>
					<div class="panel-heading">
						   <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-56026" href="#panel-element-3"> <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" ></span>
						</a> <b>ninja</b>
					</div>
					<div id="panel-element-3" class="panel-collapse collapse">
						<div class="panel-body">
							
							<a href="#"> Arquivo 1 </a>
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>

<?php 
	if(isset($_REQUEST['senhaantiga']) and isset($_REQUEST['senhanova'])){
		
		$senhaantiga = $_REQUEST['senhaantiga'];
		$senhanova = $_REQUEST['senhanova'];
		
		$alt = "SELECT senha FROM usuarios WHERE senha='$senhaantiga' and login='$login'";
		$result= mysqli_query($conexao,$alt) or die("A consulta falhou:". mysqli_error($conexao)."<br/>SQL:".$alt);
		
		if($r = mysqli_num_rows($result) > 0 ){
				$query = "UPDATE usuarios SET senha='$senhanova' WHERE login='$login'";
				
				mysqli_query($conexao,$query) or die("A consulta falhou:". mysqli_error($conexao)."<br/>SQL:".$query);
				mysqli_close($conexao);
				echo"<script>alert('Senha alterada');</script>";
					
			}
			else{
				echo"<script>alert('Senha Inválida');</script>";
			}
			
	}
?>