<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UePartidaEntidad */
?>
<?php if (!Yii::$app->request->isAjax){ ?>
<?php
$this->title = 'Partida Unidad-Ejecutora';
//Iconos
$icons=['volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',];
$this->params['breadcrumbs'][] = ['label' => 'UePartidasEntidas', 'url' => ['ue-partida-entidad/index']];
$this->params['breadcrumbs'][] = 'Partida Unidad-Ejecutora';
?>
<div class="panel panel-primary">
        <div class="panel-heading">
          <span>Partida Unidades-Ejecutora</span>
        </div>
        <div class="panel-body">

        <?php }?>
<div class="ue-partida-entidad-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           
            'cuenta',
            'partida',
             [
            'label' => 'Unidades Ejecutoras Proyecto',
            'value' => $ue
             ],
             [
            'label' => 'Unidades Ejecutoras ACC',
            'value' => $ue_acc
             ],
            
            
        ],
    ]) ?>

</div>
<?php if (!Yii::$app->request->isAjax){ ?>
</div>
</div>
<div class="btn-group">
        <?= Html::a($icons['volver'].' Volver', ['ue-partida-entidad/index'], ['class' => 'btn btn-primary']) ?>        
</div>
<?php } ?>
