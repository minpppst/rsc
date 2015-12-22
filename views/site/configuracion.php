<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

/* Iconos para los menues */
$icons = [
    'usuarios' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>',
    'roles' => '<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>',
    'permisos' => '<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>',
    'reglas' => '<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>'
]

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Configuración</h1>
        <p>Opciones de configuración del sistema.</p>
    </div>

    <div class="body-content">
        <!-- CONTROL DE ACCESO -->
    	<div class="panel panel-default estilo-panel">
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
        <!-- OTRO -->
        <div class="panel panel-default estilo-panel">
            <div class="panel-heading">
                <h1 class="panel-title">Otros Items</h1>
            </div>
            <div class="panel-body">
                <div class="list-group">                                
                    <?= Html::a('Item',null,['class' => 'list-group-item']) ?>
                </div>
            </div>
        </div>
    </div>    
</div>