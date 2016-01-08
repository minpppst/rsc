<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\tabs\TabsX; //plugin
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//Contenido de TABS
$datos_basicos = Yii::$app->controller->renderPartial('_datos-basicos',[
    'model' => $model,
    'estrategico' => $estrategico,
    'nacional' => $nacional,
    'historico' => $historico,
    'localizacion' => $localizacion,
]);

?>
<div class="proyecto-view">

    <h1>Proyecto #<?= Html::encode($this->title) ?></h1>

    <!-- TABS -->
    <?= TabsX::widget([
        'options' => [
            'class' => 'nav-justified',
        ],
        'items' => [
            [
                'label' => 'Datos Básicos',
                'content' =>$datos_basicos,
                'active' => true,
            ],
            [
                'label' => 'Alcance e Impacto',
                'content' => '',
                'linkOptions' => [
                    'data-url' => Url::to(['proyecto-alcance/view', 'id' => $model->alcance->id]),
                ],
            ],
            [
                'label' => 'Acciones Específicas',
                'content' => '',
            ],
            [
                'label' => 'Distribución Presupuestaria',
                'content' => '',
            ],
            [
                'label' => 'Fuentes de Financiamiento',
                'content' => '',
            ],
        ]
    ]) ?>
    
    

</div>

<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>