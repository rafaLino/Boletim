<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Administrador</title>
		<link rel="icon" href="imagem/icon.ico" type="image/x-icon">
		<meta charset="UTF-8">
		<meta name="viewport" content="width= devide-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="css/style.css" type="text/css" rel="stylesheet" />
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
	</head>
	
<body>
	<h2 class="text-center"> Bem-Vindo Administrador </h2>

	<header>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div id="tbbotoes">
					<!-- Nav tabs -->
						<ul class="nav nav-pills" role="tablist">
							<li role="presentation">
								<button type="button" class="btn btn-default " data-toggle="modal" data-target="#myModal1">CRIAR NOVO USUÁRIO</button>
							</li>
							<li role="presentation">
								<button type="button" class="btn btn-default " data-toggle="modal" data-target="#myModal2">CRIAR NOVA MATÉRIA</button>
							</li>
						</ul>											
					</div>
				</div>
				<div class="col-md-6">
						<?php session_start(); if(!isset($_SESSION['login'])){ session_destroy(); header('location: index.php'); echo"<script>alert('Falha de Login')";} ?>
						
						<form action="" method="POST">
							<input type="submit" name="logout" value="Sair" id="logoutadm" class="btn btn-default" />
						</form>

						<?php  if(isset($_REQUEST['logout'])){ session_start(); session_destroy(); header("Location: index.php"); exit; } ?>
				</div>
			</div>
		</div>

	</header>

	<?php
		$conexao = mysqli_connect('localhost','admin','123456') or die ("ERRO: ao tentar conexão");
		$banco = mysqli_select_db($conexao, 'banco') or die("ERRO: falha ao encontrar Banco de Dados");
		$sql = "SELECT login, nome, email, tipo, ativo FROM usuarios WHERE tipo >= '1' ORDER BY tipo ";
		$res = mysqli_query($conexao,$sql) or die("A consulta falhou:". mysqli_error($conexao)."<br/>SQL:".$sql);
	?>		
		
	<!--TABELA USUÁRIOS-->		 
							
	<div class="row">	
		<div class="col-xs-8">						
			<table class='table' border="2">
				<caption>Usuários</caption>
					<thead>
						<tr>
							<td></td>
							<th>Login</th>
							<th>Nome</th>
							<th>E-mail</th>
							<th>Ativo</th>
							<th>&nbsp</th>
						</tr>
					</thead>	 	
					
					<?php while($campo = mysqli_fetch_array($res)) {
						$atv = $campo["ativo"] == 1 ? 'ATIVADO' : 'DESATIVADO';
						$tipo = $campo["tipo"] == 1 ? 'Professor' : 'Aluno';
						echo "<tr><td>".$tipo."</td><td>". $campo["login"]."</td><td>".$campo["nome"]."</td><td>".$campo["email"]."</td> <td>".$atv."</td><td><a href='excluir.php?login=".$campo["login"]."'><span id='edit' class='glyphicon glyphicon-trash' aria-hidden='true'></span></a> <a href='editar.php?login=".$campo['login']."'><span id='edit' class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>";
						if($atv == 'ATIVADO'){
							echo"<a id='ativador' href='desativar.php?login=".$campo['login']."'> Desativar</a></td></tr>";
						}
						else {
							echo"<a id='ativador' href='ativar.php?login=".$campo['login']."'>Ativar</a></td></tr>";
						}
					} ?>
			</table></br> 
		</div>
	</div>			

	<div id="tbmaterias">
	
		<?php
		$query = "SELECT * FROM materias ";
		$tab = mysqli_query($conexao,$query) or die("A consulta falhou:". mysqli_error($conexao)."<br/>SQL:".$tab);
		?>

		<!--TABELA MATERIAS-->		 

		<div class="row">	
			<div class="col-xs-8">	
				<table class='table' border="2">
					<caption>Matérias</caption>
						<thead>
							<tr>
								<th>Sigla</th>
								<th>Disciplina</th>
								<th>Curso</th>
								<td> &nbsp </td>
							</tr>
						</thead>
						
						<?php 	
						while($materias = mysqli_fetch_array($tab)){
							echo"<tr><td>".$materias["sigla"]."</td><td>".utf8_encode($materias["nome"])."</td><td>".$materias["curso"]."</td><td><a href='excluir.php?id=".$materias["id"]."'><span id='edit' class='glyphicon glyphicon-trash' aria-hidden='true'></span></a></td></tr>";
							}
						?>
				</table></br>
			</div>
		</div>
	</div>	
					

				<!-- BOTÃO 1 NOVO USUARIO -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Novo Usuário</h4>
				</div>

				<!-- FORM  USUARIO-->
			<div class="modal-body">
				<form class="form-horizontal" action="criar.php" method="POST">
					<div class="form-group" id="formgroup2">
						<label for="login" class="col-sm-2 control-label">Login</label>
						<input type="text" class="form-control text-center"  name="login"  id="inputlogin" placeholder="Login">
					</div>

					<div class="form-group" id="formgroup2">
						<label for="nome" class="col-sm-2 control-label">Nome</label>
						<input type="text" class="form-control text-center"  name="nome"  id="inputnome" placeholder="Nome">
					</div>

					<div class="form-group" id="formgroup2">
						<label for="senha" class="col-sm-2 control-label">Senha</label>
						<input type="password" class="form-control text-center" name="senha"  id="inputsenha" placeholder="Senha">
					</div>

					<div class="form-group" id="formgroup2">
						<label for="email" class="col-sm-2 control-label">E-mail</label>
						<input type="email" class="form-control text-center" name="email"  id="inputemail" placeholder="E-mail">
					</div>

					<div class="radio">
						<label>
							<input type="radio" name="tipo" checked id="tipo" value="1">
							Professor
						</label>
					</div>

					<div class="radio">
						<label>
							<input type="radio" name="tipo" id="tipo" value="2">
							Aluno
						</label>
					</div>
		
					<div class="modal-footer">
						<button type="submit" name="create" class="btn btn-default" >Salvar Alterações</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
									

 
				<!-- BOTÃO 2 ADICIONAR MATÉRIA -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Adicionar Matéria</h4>
			</div>
				<!-- FORM MATERIAS -->
			<div class="modal-body">
				<form class="form-horizontal" action="criar.php" method="POST">
					<div class="form-group" id="formgroup3">
						<label for="nome" class="col-sm-2 control-label">Nome</label>
						<input type="text" name="nome" class="form-control text-center"  id="inputnome" placeholder="Nome da Matéria" >
					</div>

					<div class="form-group" id="formgroup3">
						<label for="sigla" class="col-sm-2 control-label">Sigla</label>
						<input type="text" name="sigla" class="form-control text-center"  id="inputsigla" placeholder="Sigla" >
					</div>

					<div class="form-group" id="formgroup3">
						<label for="curso" class="col-sm-2 control-label">Curso</label>
						<input type="text" name="curso" class="form-control text-center"  id="inputcurso" placeholder="Curso" >
					</div>

					<div class="modal-footer">
						<button type="submit" name="createmat" class="btn btn-default" >Salvar Alterações</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
<footer>
	<h6 class="text-center">Instituição - Todos os Direitos Reservados © 2016</h6>
</footer>
</html>