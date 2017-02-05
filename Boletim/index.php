<!DOCTYPE html>
<html lang="pt-br">
		<head>
			<title>Instituição</title>
			<link rel="icon" href="imagem/icon.ico" type="image/x-icon">
			<meta charset="UTF-8">
			<meta name="viewport" content="width= devide-width, initial-scale=1">
			<link href="css/bootstrap.min.css" rel="stylesheet"/>
			<link href="css/style.css" rel="stylesheet" />
			<script src="js/jquery-3.1.1.min.js"></script>
			<script src="js/bootstrap.min.js"></script>	
		</head>

<body>
	<div class="container">
		<form class="form-signin" action="" method="POST">
	        <h1  class="form-signin-heading" id="tituloindex">INSTITUIÇÃO</h1>
	        <label for="inputEmail" class="sr-only">Login</label>
	        <input type="text" name="login" id="input" class="form-control text-center" placeholder="Login" required autofocus>
	        <label for="inputPassword" class="sr-only">Senha</label></br>
	        <input type="password" name="senha" id="input" class="form-control text-center" placeholder="Senha" required>
	        
			<span><a href="#" data-toggle="modal" data-target="#myModal"  id="esqsenha">Esqueci minha senha</a></span>
	        <button id="btn-entrar" class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
	    </form>
	</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Troca de Senha</h4>
				</div>
				<div class="modal-body">
				<form class="form-horizontal" action="" method="POST">
					<div class="form-group" id="formgroup2">
						<label for="login" class="col-sm-2 control-label">Login</label>
						<input type="text" class="form-control text-center"  name="verlogin"  id="inputlogin" placeholder="Login">
					</div>
					<div class="form-group" id="formgroup2">
						<label for="nome" class="col-sm-2 control-label">Nome</label>
						<input type="text" class="form-control text-center"  name="vernome"  id="inputnome" placeholder="Nome">
					</div>
					
					<div class="form-group" id="formgroup2">
						<label for="email" class="col-sm-2 control-label">E-mail</label>
						<input type="email" class="form-control text-center" name="veremail"  id="inputemail" placeholder="E-mail">
					</div>

					<div class="form-group" id="formgroup2">
						<label for="senha" class="col-sm-2 control-label">Nova Senha</label>
						<input type="password" class="form-control text-center" name="novasenha"  id="inputsenha" placeholder="Senha">
					</div>
						<div class="modal-footer">
						<button type="submit" name="changesenha" class="btn btn-default" >Salvar Alterações</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
		<?php //troca de senha
			if(isset($_REQUEST['verlogin']) and isset($_REQUEST['vernome']) and isset($_REQUEST['veremail']) and isset($_REQUEST['novasenha']))
			{
				$l = $_REQUEST['verlogin'];
				$n = $_REQUEST['vernome'];
				$e = $_REQUEST['veremail'];
				$s = $_REQUEST['novasenha'];
			
			$conexao = mysqli_connect('localhost','admin','123456') or die ("ERRO: ao tentar conexão");
		$banco = mysqli_select_db($conexao, 'banco') or die("ERRO: falha ao encontrar Banco de Dados");
		
			$q = "SELECT login, nome,email FROM usuarios WHERE login='$l' AND nome='$n' AND email='$e' AND ativo='1' AND tipo > 0 ";
				$v = mysqli_query($conexao,$q) or die ("A consulta falhou:". mysqli_error($conexao)."<br/>SQL:".$q);
				
				if(mysqli_num_rows($v) == 1){
						$res = "UPDATE usuarios SET senha='$s' WHERE login='$l'";
						$finish = mysqli_query($conexao,$res) or die("A atualização falhou".mysqli_error($conexao)."</br>SQL:".$res);
						echo"<div class='alert alert-success' id='errologin' role='alert'>
					<strong>Dados Confirmados </br> Senha Alterada</strong></div></br>
								 <script type='text/javascript'>
										$(document).ready(function () {
											setTimeout(function () {
												$('#errologin').fadeOut(3000);
											},1500);
										});
								</script>";
				}
				else{
					echo " <div class='alert alert-danger' id='errologin' role='alert'>
					<strong>Dados Incorretos </br> Contate Administrador</strong></div></br>
								 <script type='text/javascript'>
										$(document).ready(function () {
											setTimeout(function () {
												$('#errologin').fadeOut(3000);
											},1500);
										});
								</script>";
				}
						
			}
		?>
</body>
	<footer id="indexfooter">
		<h6 class="text-center">Instituição - Todos os Direitos Reservados © 2016</h6>
	</footer>
</html>

<?php
	if(isset($_REQUEST['login']) and isset($_REQUEST['senha'])){
	
	$conexao = mysqli_connect('localhost','admin','123456') or die ("ERRO: ao tentar conexão");
		$banco = mysqli_select_db($conexao, 'banco') or die("ERRO: falha ao encontrar Banco de Dados");
		
			$login = mysqli_real_escape_string($conexao, $_POST['login']);
			$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
			
			
			$sql = "SELECT * FROM usuarios WHERE login='$login' AND senha='$senha' AND ativo ='1'";
				
				$query = mysqli_query($conexao,$sql) or die("A consulta falhou:". mysqli_error($conexao)."<br/>SQL:".$sql);
			
					
			if($r = mysqli_num_rows($query) == 1){
							session_start();
							$_SESSION['login'] = $login;
						while($resultado = mysqli_fetch_array($query)){
							if($resultado['tipo'] == 0 ){
									header('Location: adm.php');
								}
								else if($resultado['tipo'] == 1){
									header('Location: prof.php');
								}
								else{
									header('Location: aluno.php');
								}
						}
					}
					else{
						echo " <div class='alert alert-danger' id='errologin' role='alert'><strong>Login Inválido</strong></div></br>
								 <script type='text/javascript'>
										$(document).ready(function () {
											setTimeout(function () {
												$('#errologin').fadeOut(3000);
											},1500);
										});
								</script>";
						}
	}//if isset login,senha						
?>



