<?php
namespace console\controllers;
use Yii;
use yii\console\Controller;
/**
 * 
 *
 * 
 *
 * 
 * 
 */

class AccController extends Controller
{
    /**
     * Insertar datos en la tabla Accion_centralizada
     */
    public function actionCrearAccPrueba()
    {
        $anio=date('Y');

       $resultado = Yii::$app->db->createCommand('INSERT INTO accion_centralizada(id, codigo_accion, codigo_accion_sne, nombre_accion, fecha_inicio, fecha_fin, estatus, aprobado) 
            VALUES 
            ("1","001","ACC001","Dirección y coordinación de los gastos de los trabajadores y trabajadoras", "'.$anio.'/01/01", "'.$anio.'/12/31", 1, 0),
            ("2","002","ACC002","Gestión Administrativa", "'.$anio.'/01/01", "'.$anio.'/12/31", 1, 0),
            ("3","003","ACC003","Previsión y protección social", "'.$anio.'/01/01", "'.$anio.'/12/31", 1, 0),
            ("4","004","ACC004","Asignaciones predeterminadas", "'.$anio.'/01/01", "'.$anio.'/12/31", 1, 0),
            ("5","005","ACC005","Dirección y coordinación del servicio de la deuda pública nacional", "'.$anio.'/01/01", "'.$anio.'/12/31", 1, 0),
            ("6","006","ACC006","Otras", "'.$anio.'/01/01", "'.$anio.'/12/31", 1, 0)')->execute();

       if(is_int($resultado)) //Insertados
        {
            //echo "\033[32m ".$resultado." registros insertados con éxito.\033[0m\n";


            //insertando las acciones especificas
            $resultado1 = Yii::$app->db->createCommand('INSERT INTO accion_centralizada_accion_especifica(id, id_ac_centr, cod_ac_espe, nombre, estatus, fecha_inicio, fecha_fin)
            VALUES 
            ("1", "1","001-01","Asignación y control de los recursos para gastos de los trabajadores y trabajadoras",1, "'.$anio.'/01/01", "'.$anio.'/12/31"),
            ("2", "2","002-01","Apoyo institucional a las acciones específicas de los proyectos del organismo",1, "'.$anio.'/01/01", "'.$anio.'/12/31"),
            ("3", "2","002-02","Apoyo institucional al sector privado y al sector externo",1, "'.$anio.'/01/01", "'.$anio.'/12/31"),
            ("4", "2","002-03","Apoyo institucional al sector público",1, "'.$anio.'/01/01", "'.$anio.'/12/31"),
            ("5", "3","003-01","Asignación y control de los recursos para gastos de los pensionados, pensionadas, jubilados y jubiladas",1, "'.$anio.'/01/01", "'.$anio.'/12/31"),
            ("6", "4","004-01","Asignación y control de los aportes constitucionales y legales",1, "'.$anio.'/01/01", "'.$anio.'/12/31"),
            ("7", "5","005-01","Asignación y control de los recursos para el servicio de la deuda pública nacional",1, "'.$anio.'/01/01", "'.$anio.'/12/31"),
            ("8", "6","006-01","Las determinadas según el propósito de la acción centralizada",1, "'.$anio.'/01/01", "'.$anio.'/12/31")
            ')->execute();

       if(is_int($resultado1)) //Insertados
        {
            echo "\033[32m ".$resultado1." registros insertados con éxito.\033[0m\n";
        }






        }
    }
}