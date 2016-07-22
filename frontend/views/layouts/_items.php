<?php
	use yii\web\Html;
	use yii\web\Url;
    
    
    //$req = Yii::$app->user->can('proyecto-pedido/index') || Yii::$app->user->can('accion-centralizada-pedido/index') ? true : false;
    
	
    /*
	 * Items del menu principal
	 */

     $items = [
        //INICIO
        ['label' => $icons['inicio'].' Inicio', 'url' => ['/site/index']],
     ];

     if(!Yii::$app->user->isGuest)
     {
        //PROYECTO
        $items[] = ['label' => $icons['proyecto'].' Proyecto', 'url' => ['/proyecto/index'], 'visible' => Yii::$app->user->can('proyecto/index')];
        //ACCION CENTRAL
        $items[] = ['label' => $icons['acc'].' Acción Centralizada', 'url' => ['/accion-centralizada'], 'visible' => Yii::$app->user->can('accion-centralizada/index')];
        //REQUERIMIENTOS
        $items[] = ['label' => $icons['pedido'].' Requerimientos','visible' => Yii::$app->user->identity->canRequerimientos(), 'items' =>
            [
                ['label' => $icons['proyecto'].' Proyecto', 'url' => ['/proyecto-pedido/index']],
                ['label' => $icons['acc'].' Acción Centralizada', 'visible'=>Yii::$app->user->identity->hasRequirements(), 'url' => ['/accion-centralizada-pedido/index']],
            ]
        ];
        
        //VARIABLES
        $items[] = ['label' => $icons['variable'].' Variables','visible' => Yii::$app->user->identity->canVariables(), 'items' =>
            [
                ['label' => $icons['proyecto'].' Proyecto', 'visible' => false, 'url' => ['/proyecto-variables/index']],
                ['label' => $icons['acc'].' Acción Centralizada',  'visible' => Yii::$app->user->identity->hasVariables(), 'url' => ['/accion-centralizada-variable-ejecucion/variables']],
            ]
        ];
     }
    
    
    //LOGIN/LOGOUT
    if(Yii::$app->user->isGuest)
    {
        $items[] = ['label' => $icons['entrar'].' Entrar', 'url' => ['/user/security/login']];
    }
    else
    {
        $items[] = ['label' => $icons['salir'].' Salir (' . Yii::$app->user->identity->username . ')', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']
            ]
        ;
    }    
    
    return $items;
        
?>