<?php
	use yii\web\Html;
	use yii\web\Url;
    
    
    $req = Yii::$app->user->can('proyecto-pedido/index') || Yii::$app->user->can('accion-centralizada-pedido/index') ? true : false;
    
	
    /*
	 * Items del menu principal
	 */    

	return [
            ['label' => $icons['inicio'].' Inicio', 'url' => ['/site/index']],
            ['label' => $icons['pedido'].' Requerimientos','visible' => $req, 'items' =>[
                ['label' => $icons['proyecto'].' Proyecto', 'url' => ['/proyecto-pedido/index']],
                ['label' => $icons['acc'].' Acción Centralizada', 'visible'=>Yii::$app->user->identity->hasRequirements, 'url' => ['/accion-centralizada-pedido/index']],
            ]],
            ['label' => $icons['pedido'].' Variables','visible' => Yii::$app->user->identity->canVariables, 'items' =>[
                ['label' => $icons['proyecto'].' Proyecto', 'visible' => $variablesp, 'url' => ['/proyecto-variables/index']],
                ['label' => $icons['acc'].' Acción Centralizada',  'visible' => Yii::$app->user->identity->hasVariables, 'url' => ['/accion-centralizada-variable-ejecucion/variables']],
            ]],            
            ['label' => $icons['proyecto'].' Proyecto', 'url' => ['/proyecto/index'], 'visible' => Yii::$app->user->can('proyecto/index')],
            ['label' => $icons['acc'].' Acción Centralizada', 'url' => ['/accion-centralizada'], 'visible' => Yii::$app->user->can('accion-centralizada/index')],                        

            Yii::$app->user->isGuest ?
                ['label' => $icons['entrar'].' Entrar', 'url' => ['/user/security/login']] :
                [
                    'label' => $icons['salir'].' Salir (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ]
?>