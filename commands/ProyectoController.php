<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ProyectoController extends Controller
{
    /**
     * Insertar Datos en la tabla proyecto
     */
    public function actionCrearProyectoPrueba()
    {
        Yii::$app->db->createCommand()->insert('proyecto', [
            'id' => '999999',
        	'codigo_proyecto' => '9999', 
        	'codigo_sne' => '9999',  
        	'nombre' => 'Proyecto de prueba', 
        	'estatus_proyecto' => 1, 
        	'situacion_presupuestaria' => 1, 
        	'monto_proyecto' => 9999, 
        	'descripcion' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 
        	'sector' => 1, 
        	'sub_sector' => 1, 
        	'plan_operativo' => 1, 
        	'objetivo_general' => 1, 
        	'objetivo_estrategico_institucional' => 'Praesent a rhoncus sapien, quis rutrum felis. Maecenas placerat, enim in euismod tincidunt, magna quam laoreet augue, at facilisis purus risus nec leo. Pellentesque pulvinar, augue at fringilla vulputate, lorem nulla finibus justo, suscipit pretium risus dolor vel diam.', 
        	'ambito' => 1
        ])->execute();
    }
}
