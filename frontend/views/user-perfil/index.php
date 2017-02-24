<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserPerfilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perfil De Usuario '.Yii::$app->user->identity->username;
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="user-perfil-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=> $bandera==0 
                    ?
                        Html::a('<i class="glyphicon glyphicon-pencil"></i> Editar Perfil', ['create'],
                        ['role'=>'modal-remote','title'=> 'Editar Perfil','class'=>'btn btn-default']).
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Recargar Grid']).
                        '{export}'
                    :
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Recargar Grid']).
                        '{export}'

                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => 
            [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Perfil De Usuario',
                'before'=> $bandera==0
                    ? 
                        '<em>*Por favor complete su perfil de usuario.</em>'
                    :   
                        '',

            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
