<?php
namespace console\controllers;
use Yii;
use yii\console\Controller;

/**
 * Manipular la tabla partida_partida
 */
class PartidaPartidaController extends Controller
{
	/**
	 * Cargar la lista de partidas a la BD
	 */
	public function actionCargar()
	{
		echo "Insertando registros...\n";
		
		$resultado = Yii::$app->db->createCommand('INSERT INTO partida_partida (cuenta, partida, nombre, estatus) VALUES
			("3","01","Ingresos ordinarios",1),
			("3","02","Ingresos extraordinarios",1),
			("3","03","Ingresos de operación",1),
			("3","04","Ingresos ajenos a la operación",1),
			("3","05","Transferencias y donaciones",1),
			("3","06","Recursos propios de capital",1),
			("3","07","Venta de títulos y valores que no otorgan propiedad",1),
			("3","08","Venta de acciones y participaciones de capital",1),
			("3","09","Recuperación de préstamos de corto plazo",1),
			("3","10","Recuperación de préstamos de largo plazo",1),
			("3","11","Disminución de otros activos financieros",1),
			("3","12","Incremento de pasivos",1),
			("3","13","Incremento del patrimonio",1),
			("4","01","Gastos de personal",1),
			("4","02","Materiales, suministros y mercancías",1),
			("4","03","Servicios no personales",1),
			("4","04","Activos reales",1),
			("4","05","Activos financieros",1),
			("4","06","Gastos de defensa y seguridad del estado",1),
			("4","07","Transferencias y donaciones",1),
			("4","08","Otros gastos",1),
			("4","09","Asignaciones no distribuidas",1),
			("4","10","Servicio de la deuda pública",1),
			("4","11","Disminución de pasivos",1),
			("4","12","Disminución del patrimonio",1),
			("4","98","Rectificaciones al presupuesto",1)')
		->execute();

		if(is_int($resultado)) //Insertados
		{
			echo "\033[32m ".$resultado." registros insertados con éxito.\033[0m\n";
		}
		
	}
}