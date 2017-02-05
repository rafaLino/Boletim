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
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" media="all"/>										  
	</head>

<body>
	<header>
		<?php session_start(); if(!isset($_SESSION['login'])){ session_destroy(); header('location: index.php'); echo"<script>alert('Falha de Login')";} ?>
		<h2 class="text-center"> Bem-Vindo Professor  <?php echo $_SESSION['login']; 
		?> 
		</h2>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<ul class="nav nav-pills">
							<li role="presentation"><a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-default" id="altersenhaprof">Alterar Senha</a></li>	  
						</ul>
					</div>
					<div class="col-md-6">
						<form action="" method="POST">
							<input type="submit" name="logout" value="Sair" id="logoutprof" class="btn btn-default" />
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
					
		$sql = "SELECT usuarios.login, usuarios.nome,notas.id AS idnota , materias.nome AS matname,notas.p1,notas.p2,notas.faltas FROM notas JOIN usuarios ON id_usuario=login JOIN materias ON id_materia = materias.id WHERE tipo='2' AND ativo='1' ORDER BY materias.nome";
		$res = mysqli_query($conexao,$sql) or die("A consulta falhou:". mysqli_error($conexao)."<br/>SQL:".$sql);
		$same = null;
			
			echo"<table class='table table-hover text-center' border='2'>
			<tr><th>Disciplina</th><th>Nome</th><th>Faltas</th><th>Nota</th><th>Nota</th><th>Média</th></thead>";
					
			While($cmp = mysqli_fetch_array($res)){
				echo"<tbody><tr><td>".utf8_encode($cmp['matname'])."</td><td>".utf8_encode($cmp['nome'])."</td>
					<td><a data-toggle='tooltip' title='Alterar Faltas' href='faltas.php?falta=".$cmp["idnota"]."'>".$cmp['faltas']."</a></td>
					<td><a data-toggle='tooltip' title='Alterar Nota' href='nota1.php?idnota=".$cmp["idnota"]."'>".$cmp['p1']."</a></td>
					<td><a data-toggle='tooltip' title='Alterar Nota'  href='nota2.php?idnota2=".$cmp["idnota"]."'>".$cmp['p2']."</a></td>
					<td>".($cmp['p1']+$cmp['p2'])/2 ."</td></tr></tbody>";
												
								
					} echo"</table></br>";  
?>						
							
<!-- TOOLTIP data-toggle="tooltip" title="" -->				
<div class="tooltip top" id="tooltip" role="tooltip">
	<div class="tooltip-arrow">
  		<div class="tooltip-inner">
    	Alterar Nota!
		</div>
	</div>
</div>
	<script>
		$(function () {
  			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
 <!--TOOLTIP -->
				

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center" id="myModalLabel">Alterar Senha</h4>
			</div>
			<div class="modal-body">
			<form class="form-inline" action="" method="POST">
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
						<button type="button" class="btn btn-default" id="adicionarprof" >Adicionar</button>  
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
						<button type="button" class="btn btn-default" id="adicionarprof" >Adicionar</button>
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
						<button type="button" class="btn btn-default" id="adicionarprof" >Adicionar</button>
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
	<hr style="margin-top: 0px">
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
