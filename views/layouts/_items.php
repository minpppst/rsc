<?php
	use yii\web\Html;
	use yii\web\Url;

	/*
	 * Items del menu principal
	 */

	return [
            ['label' => $icons['inicio'].' Inicio', 'url' => ['/site/index']],
            ['label' => $icons['pedido'].' Pedidos', 'url' => ['/proyecto-pedido/index'], 'visible' => Yii::$app->user->can('proyecto-pedido/index')],
            ['label' => $icons['asignar'].' Asignar', 'url' => ['/proyecto-asignar/index'], 'visible' => true],
            ['label' => $icons['proyecto'].' Proyectos', 'url' => ['/proyecto/index'], 'visible' => Yii::$app->user->can('proyecto/index')],
            ['label' => $icons['acc'].' Acción Centralizada', 'url' => ['/accion-centralizada'], 'visible' => Yii::$app->user->can('accion-centralizada/index')],            
            ['label' => $icons['config'].' Configuración', 'url' => ['/site/configuracion'], 'visible' => Yii::$app->user->can('site/configuracion')],
            //['label' => 'Acerca de', 'url' => ['/site/about']],
            //['label' => 'Contacto', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ?
                ['label' => $icons['entrar'].' Entrar', 'url' => ['/user/security/login']] :
                [
                    'label' => $icons['salir'].' Salir (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ]
?>