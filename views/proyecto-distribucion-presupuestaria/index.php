<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\JsExpression;

use app\models\ProyectoAccionEspecifica;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoDistribucionPresupuestariaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyecto Distribucion Presupuestarias';
$this->params['breadcrumbs'][] = $this->title;

?>

<!-- BOTONES -->
<p>
    <?= Html::a('Editar', ['proyecto-distribucion-presupuestaria/update', 'proyecto' => $proyecto], ['class' => 'btn btn-primary']) ?>    
</p>

<div>
    <table class="table">
        <thead>
            <tr>
                <th>Acción Específica</th>
                <?php 
                    foreach ($partidas as $partida) 
                    {
                ?>
                <th><?= Html::encode($partida->partida) ?></th>
                <?php
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php                
                foreach ($modelos as $key => $value) 
                {                     
                    echo Yii::$app->controller->renderPartial('_datos',[
                        'model' => $value,
                    ]);                    
                    
                }
            ?>
        </tbody>
    </table>
</div>