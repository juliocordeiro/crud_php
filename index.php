<?php
	function __autoload($class_name){
		require_once 'classes/' . $class_name . '.php';
	}
?>

<!DOCTYPE HTML>
<html land="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
   <title>Sistema de Cadastro</title>
  <meta name="description" content="PHP OO" />
  <meta name="robots" content="index, follow" />
   <meta name="author" content="Andrew Esteves"/>
   <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" />
  <!--[if lt IE 9]>
      <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
   <![endif]-->
</head>
<body>

	

		<?php
	
		$usuario = new usuarios();

		if(isset($_POST['cadastrar'])):

			$nome_usuario  = $_POST['nome_usuario'];
			$email_usuario = $_POST['email_usuario'];

			$usuario->setNome($nome_usuario);
			$usuario->setEmail($email_usuario);
                        $usuario->insert();

			# Insert
			if($usuario->insert()){
				echo "Inserido com sucesso!";
			}

		endif;

		?>
		<header class="masthead">
			<h1 class="muted">Sistema de  Cadastro</h1>
			<nav class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<ul class="nav">
							<li class="active"><a href="index.php">Página inicial</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>

		<?php 
		if(isset($_POST['atualizar'])):

			$id_usuario = $_POST['id_usuario'];
			$nome_usuario = $_POST['nome_usuario'];
			$email_usuario = $_POST['email_usuario'];

			$usuario->setNome($nome_usuario);
			$usuario->setEmail($email_usuario);

			if($usuario->update($id_usuario)){
				echo "Atualizado com sucesso!";
			}

		endif;
		?>

		<?php
		if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):

			$id_usuario = (int)$_GET['id_usuario'];
			if($usuario->delete($id_usuario)){
				echo "Deletado com sucesso!";
			}

		endif;
		?>

		<?php
		if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){

			$id_usuario = (int)$_GET['id_usuario'];
			$resultado = $usuario->find($id_usuario);
		?>

		<form method="post" action="">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
				<input type="text" name="nome_usuario" value="<?php echo $resultado->nome_usuario; ?>" placeholder="Nome:" />
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
				<input type="text" name="email_usuario" value="<?php echo $resultado->email_usuario; ?>" placeholder="E-mail:" />
			</div>
			<input type="hidden" name="id_usuario" value="<?php echo $resultado->id_usuario; ?>">
			<br />
			<input type="submit" name="atualizar" class="btn btn-primary" value="Atualizar dados">					
		</form>

		<?php }else{ ?>


		<form method="post" action="">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
				<input type="text" name="nome_usuario" placeholder="Nome:" />
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
				<input type="text" name="email_usuario" placeholder="E-mail:" />
			</div>
			<br />
			<input type="submit" name="cadastrar" class="btn btn-primary" value="Cadastrar dados">					
		</form>

		<?php } ?>

		
			
			<thead>
				<tr>
					<th>#</th>
					<th>Nome:</th>
					<th>E-mail:</th>
					<th>Ações:</th>
				</tr>
			</thead>
		
			<?php foreach($usuario->findAll() as $key => $value): ?>                            

			<tbody>
				<tr>
					<td><?php echo $value->id_usuario; ?></td>
					<td><?php echo $value->nome_usuario; ?></td>
					<td><?php echo $value->email_usuario; ?></td>
					<td>
						<?php echo "<a href='index.php?acao=editar&id=" . $value->id_usuario . "'>Editar</a>"; ?>
						<?php echo "<a href='index.php?acao=deletar&id=" . $value->id_usuario . "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
					</td>
				</tr>
			</tbody>

			<?php endforeach ?>

		

	

<script src="js/jQuery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>