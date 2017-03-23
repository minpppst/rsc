<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAsignar */
$this->title = 'Generar Reporte 1 Presupuesto';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="accion-centralizada-asignar-create">
    <?= $this->render('_reporte1',
        [
			'proyectos' => $proyectos, 
			'accion_centralizada' => $accion_centralizada,
			'unidadesejecutoras' => $unidadesejecutoras,
			'variablesproyecto' => $variablesproyecto,
        	'variablescentral' => $variablescentral,
        	'meses' => $meses,
   		]);
    ?>
</div>