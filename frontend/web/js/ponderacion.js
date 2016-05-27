/*
 * ponderacion.js
 */

 $(document).ready(function(){

 	var maximo = 1 - $('#ponderacionTotal').val();

 	$('#proyectoaccionespecifica-ponderacion').attr({
 		'max' : maximo,
 		'min' : 0.1
 	});
 	
 });