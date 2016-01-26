<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Button;

/* Iconos para los menues */
$icons = [
    'info' => '<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>',
    'usuarios' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>',
    'roles' => '<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>',
    'permisos' => '<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>',
    'reglas' => '<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>',
    'partidas' => '<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>',
    'objetivos' => '<span class="glyphicon glyphicon-screenshot" aria-hidden="true"></span>',
    'unidadEjecutora' => '<span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>',
    'respaldos' => '<span class="glyphicon glyphicon-hdd" aria-hidden="true"></span>',
    'medida' => '<span class="glyphicon glyphicon-scale" aria-hidden="true"></span>',

];

$caret = '<p style="float:right"><span class="caret"></span></p>';

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Configuración</h1>
        <p>Opciones de configuración del sistema.</p>
    </div>

    <div class="body-content">
        <!-- CONTROL DE ACCESO -->
    	<div class="panel panel-danger estilo-panel">
    		<div class="panel-heading">
    			<h1 class="panel-title">Control de Acceso</h1>
    		</div>
    		<div class="panel-body">
    			<div class="list-group">		    					
					<?= Html::a($icons['usuarios'].' Usuarios',Url::to(['user/manager']),['class' => 'list-group-item']) ?>
					<?= Html::a($icons['roles'].' Roles',Url::to(['rbac/role']),['class' => 'list-group-item']) ?>
					<?= Html::a($icons['permisos'].' Permisos',Url::to(['rbac/permission']),['class' => 'list-group-item']) ?>
					<?= Html::a($icons['reglas'].' Reglas',Url::to(['rbac/rule']),['class' => 'list-group-item']) ?>
				</div>
    		</div>
		</div>
        <!-- PROPIEDADES -->
        <div class="panel panel-info estilo-panel">
            <div class="panel-heading">
                <h1 class="panel-title">Propiedades</h1>
            </div>
            <div class="panel-body">
                <div class="list-group">                                
                    <?= Html::a($icons['partidas'].' Partidas',Url::to(['partida/index']),['class' => 'list-group-item']) ?>
                    <div class="list-group-item" style="padding:0px">
                        <?= Html::a($icons['objetivos'].' Objetivos'.$caret,'#',[
                            'class' => 'list-group-item dropdown-toggle',
                            'style' => 'border:0px',
                            'data-toggle'=>'dropdown',
                            'aria-haspopup'=>true, 
                            'aria-expanded'=>false,
                        ]) ?>
                        <ul class="dropdown-menu pull-right">
                            <li><?= Html::a('Historicos',Url::to(['objetivos-historicos/index'])) ?></li>
                            <li><?= Html::a('Nacionales',Url::to(['objetivos-nacionales/index'])) ?></li>
                            <li><?= Html::a('Estratégicos',Url::to(['objetivos-estrategicos/index'])) ?></li>
                            <li><?= Html::a('Generales',Url::to(['objetivos-generales/index'])) ?></li>
                        </ul>
                    </div>                    
                    <?= Html::a($icons['unidadEjecutora'].' Unidades Ejecutoras',Url::to(['unidad-ejecutora/index']),['class' => 'list-group-item']) ?>
                    <?= Html::a($icons['medida'].' Unidades de Medida',Url::to(['unidad-medida/index']),['class' => 'list-group-item']) ?>
                </div>
            </div>
        </div>

        <!-- SISTEMA -->
        <div class="panel panel-warning estilo-panel">
            <div class="panel-heading">
                <h1 class="panel-title">Sistema</h1>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    <?= Html::a($icons['respaldos'].' Respaldos', Url::to(['backuprestore/default/index']),['class' => 'list-group-item']) ?>
                    <?= Html::a($icons['info'].' Item', null,['class' => 'list-group-item']) ?>
                    <?= Html::a($icons['info'].' Item', null,['class' => 'list-group-item']) ?>
                    <?= Html::a($icons['info'].' Item', null,['class' => 'list-group-item']) ?>
                </div>
            </div>
        </div>
    </div>    
</div>