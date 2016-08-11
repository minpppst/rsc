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

class PartidaUnidadesController extends Controller
{
    /**
     * Insertar datos en la tabla ue_partidas_entidad
     */
    public function actionCrearPartidaUnidades()
    {
        
        $resultado= Yii::$app->db->createCommand(
            'INSERT INTO ue_partida_entidad(cuenta, partida, id_ue, id_tipo_entidad) select cuenta, partida, b.id, c.id from partida_partida, unidad_ejecutora as b, tipo_entidad as c where cuenta like "4%"'
            )->execute();

        

       if(is_int($resultado)) //Insertados
        {
       
            echo "\033[32m ".$resultado." registros insertados con éxito.\033[0m\n";
       
        }
    }
}