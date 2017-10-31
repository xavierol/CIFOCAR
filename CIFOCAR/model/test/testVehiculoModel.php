<?php
require '../../config/Config.php';
require '../../libraries/database_library.php';
require '../VehiculoModel.php';

//TEST GUARDADO
/*
$coche = new VehiculoModel();

$coche->matricula = '1234RRR';
$coche->modelo = 'fiesta';
$coche->color = 'rojo';
$coche->precio_venta = 5000;
$coche->precio_compra = 4000;
$coche->kms = 5000;
$coche->caballos = 80;
$coche->any_matriculacion = 1992;
$coche->image = 'algo';
$coche->marca = 'ford';

if($coche->guardar()) echo 'EXITO';

*/
//TEST RECUPERAR POR ID
//var_dump(VehiculoModel::getVehiculos(2));
$vehiculo = VehiculoModel::getVehiculo(5);
var_dump($vehiculo);

//TEST RECUPERAR
//var_dump(VehiculoModel::getVehiculos());
/*
$vehiculos = VehiculoModel::getVehiculos();

foreach($vehiculos as $m){
    echo "<p>$m->matricula</p>";
    echo "<p>$m->modelo</p>";
    echo "<p>$m->color</p>";
    echo "<p>$m->precio_venta</p>";
    echo "<p>$m->precio_compra</p>";
    echo "<p>$m->kms</p>";
    echo "<p>$m->caballos</p>";
    echo "<p>$m->any_matriculacion</p>";
    echo "<p>$m->imagen</p>";
    echo "<p>$m->marca</p>";
}

*/

//TEST ACTUALIZAR
//echo MarcaModel::actualizar('Citroën','citroen');


//TEST BORRAR
//echo MarcaModel::borrar('fiat');

?>