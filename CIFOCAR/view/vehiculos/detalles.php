<!DOCTYPE html>
<html lang="ca">
    <head>
    		<base href="<?php echo Config::get()->url_base;?>" />
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
                <h2>Detalles del Vehículo <?php echo $vehículo->modelo;?></h2>
                
                <h3>Tiempo de preparación</h3>
                <p>Esta receta estará lista en
                    <?php echo $receta->tiempo;?> minutos.</p>
                
                <h3>Dificultad</h3>
                <p>Esta receta tiene un nivel de dificultad
                calificado como <b><?php echo $receta->dificultad;?></b>.</p>
                
                
                <h3>Ingredientes</h3>
                <p><?php echo $receta->ingredientes;?></p>
                
                <h3>Descripción</h3>
                <p><?php echo $receta->descripcion;?></p>
                
                
    </section>
            
    <footer>
    </footer>
    
    </body>
</html>
