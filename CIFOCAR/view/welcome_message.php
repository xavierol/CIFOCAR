<?php if(empty ($GLOBALS['index_access'])) die('no se puede acceder directamente a una vista.'); ?>
<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<title>Portada</title>
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
			<h2>CIFOCAR COMPRAMOS Y VENDEMOS</h2>
			<p>CIFOCAR es una empresa que cuenta con la experiencia de 49 años en el sector. 
			<b>nuestros métodos son innovadores </b> Esta aplicación interna pretende agilizar nuestro trabajo diario</b>.</p>
			
			<p>Hay una serie de operaciones<b>Compra, venta y administración del sistema</b> para entender el sistema
			en todos sus campos de actuación, existe un manual de esta aplicación sencilla. Disponemos de personal cualificado
			para ayudar a la mejora de éste.Todas las aportaciones se consideran importantes para nosotros.</p>
			
			<p>Como administrador puedes manejar usuadios y la lista de coches, tienes una serie de opciones a elegir. Podrás
			listar, modificar y borrar información de los campos arriba reseñadosherramientas de trabajo.</p>
			
			<p><b>Es una aplicación interna</b>,cualquier problema debería ser comunicado a la gerencia de la empresa para mejorarla
			se puedn dirigir a la oficina.</p>
			
			<img alt="Robs Micro Framework logo" src="images/logos/logocifo.png" />
		</section>
		
		<?php Template::footer();?>
    </body> 
</html>