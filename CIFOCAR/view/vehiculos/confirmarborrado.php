<!DOCTYPE html>
<html lang="es">
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Borrar Vehículo</title>
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
            <h2>Confirmar borrado de <?php echo $vehiculo->modelo;?></h2>
            
            <p>Estos son los datos del vehículo a borrar:</p>

            <h3>Marca</h3>
            <p><?php echo $vehiculo->marca;?></p>
            
            <h3>Matrícula</h3>
            <p><?php echo $vehiculo->matricula;?></p>
            
            <h3>Modelo</h3>
            <p><?php echo $vehiculo->modelo;?></p>
            
            
            <form method="POST">
                <label>Estas seguro?</label>
                <input type="submit" name="confirmarborrado" value="Confirmar" />
                <input type="button" onclick="history.back();" value="Cancelar"/>
            </form>
            
        </section>
		
		
		
		
		<?php Template::footer();?>
    </body>
</html>
