<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LocalizacionAccVariable */

//$this->title = "Localización Y Programación De Variable";
//$this->params['breadcrumbs'][] = ['label' => 'Localizacion Acc Variables', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localizacion-acc-variable-view">

    
    <table align="center" width="500" border="0">
        <tr>
            <td align="center">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'nombreVariable',
                        'nombrePais',
                        'nombreEstado',
                        ],
                ]) ?>
            </td>
        </tr>
        <tr>
            <td>
                 <?= DetailView::widget([
                    'model' => $model1,
                    'attributes' => [
                        'trimestre1',
                        'trimestre2',
                        'trimestre3',
                        'trimestre4',
                        'totalTrimestre',
                        
                    ],
                ]) ?>
            </td>
        </tr>
    </table>
</div>
