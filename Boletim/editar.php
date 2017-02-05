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
	<?php	
			session_start();
						if(!isset($_SESSION['login']) and $_SESSION['tipo']>0){ 
								session_destroy(); 
										header('location: index.php'); 
										echo"<script>alert('Falha de Login')";
										}

			$login = $_REQUEST['login'];
			$conexao = mysqli_connect('localhost','admin','123456') or die("ERRO: sem conexão.");
				$banco = mysqli_select_db($conexao,'banco') or die("ERRO: Não foi possível selecionar o BD.");
		
			$sql = "SELECT nome, senha, email, tipo FROM usuarios WHERE login='$login'";
		
			$resultado = mysqli_query($conexao,$sql) or die("A consulta falhou:". mysqli_error($conexao)."<br/>SQL:".$sql);
			
		if($campo = mysqli_fetch_array($resultado)){
	?>
		<form class="form-horizontal" action="" method="POST">
			<div class="form-group">
				<label class="col-sm-2 control-label">LOGIN:</label>
					<div class="col-sm-10">
					  <p class="form-control-static"> <?php echo $login ;?> </p>
					</div>
			</div>

			<div class="form-group" id="formgroup1">
				<label for="nome" class="col-sm-2 control-label">Nome</label>
					<input type="text" class="form-control text-center" value="<?php echo $campo["nome"] ?>" name="nome"  id="inputnome" placeholder="Nome">
			</div>

			<div class="form-group" id="formgroup1">
				<label for="senha" class="col-sm-2 control-label">Senha</label>
					<input type="text" class="form-control text-center" value="<?php echo $campo["senha"] ?>" name="senha"  id="inputsenha" >
			</div>

			<div class="form-group" id="formgroup1">
				<label for="email" class="col-sm-2 control-label">E-mail</label>
					<input type="email" class="form-control text-center" value="<?php echo $campo["email"] ?>" name="email"  id="inputemail" >
			</div>

			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<div class="radio" id="tipo1">
							<label>
								<input type="radio" name="tipo" checked id="tipo" value="1">
								Professor
							</label>
						</div>
					</div>	
					<div class="col-md-6">
						<div class="radio">
							<label>
								<input type="radio" name="tipo" id="tipo2" value="2">
								Aluno
							</label>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="modal-footer" id="modalfooter1">
					<button type="submit" name="alterar" class="btn btn-default" >Salvar Alterações</button>
					<button type="button" class="btn btn-default" onclick=location.href="adm.php"  data-dismiss="modal">Cancelar</button>
				</div>
			</div>	
		</form>
	<?php } ?>	
				 
</body>
</html>

<?php 
		if(isset($_REQUEST['alterar'])){
		
					if(isset($_REQUEST['nome'])){
						$nome = $_REQUEST['nome'];
					}
					$senha = $_REQUEST['senha'];
					$email	= $_REQUEST['email'];
					$tipo = $_REQUEST['tipo'];
					
					$res = "UPDATE usuarios SET nome='$nome', senha='$senha', email='$email',tipo='$tipo' WHERE login='$login'";
					
					$query = mysqli_query($conexao,$res) or die("A Alteração falhou: ".mysqli_error($conexao)."<br/>SQL: ".$sql);
					
					mysqli_close($conexao);
			
				header('location: adm.php');
			}
?>


