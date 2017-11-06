<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Registro de usuarios</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
	</head>
	
	<body>
		<?php 
			Template::header(); //pone el header

			if(!$usuario) Template::login(); //pone el formulario de login
			else Template::logout($usuario); //pone el formulario de logout
			
			Template::menu($usuario); //pone el menú
		?>
		
		<section id="content">
			<h2>Nueva marca</h2>
			<form method="post" enctype="multipart/form-data" autocomplete="off">
				
										
				<label>Marca:</label>
				<input type="text" name="marca" required="required"/><br/>
 
 //Para la lista de marcas, poner la tabla
 
 
				<input type="submit" name="guardar" value="guardar"/><br/>
			</form>
		</section>
		
		<?php Template::footer();?>
    </body>
</html>