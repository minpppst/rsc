<?php
use \kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use kartik\select2\Select2;
\kartik\select2\Select2Asset::register($this);





/* @var $this yii\web\View */
/* @var $searchModel app\models\AcAcEspecSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Accion Centralizada Accion Especifica';
$this->params['breadcrumbs'][] = $this->title;
//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'importar'=>'<span class="glyphicon glyphicon-import" aria-hidden="true"></span>',
];
CrudAsset::register($this);
?>
<div class="ac-ac-espec-index">


           <?=GridView::widget([
            'id'=>'especifica',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>                  
                    Html::a($icons['crear'].' Agregar', ['create','ac_centralizada' => $searchModel['id_ac_centr']],
                    ['role'=>'modal-remote','title'=> 'Crear Nueva  Accion Especifica','class'=>'btn btn-success']).
                    '{toggleData}'.
                    '{export}'.
                     Html::a($icons['importar'].' Importar', ['/ac-ac-espec/importar','accion_central' => $searchModel['id_ac_centr']],
                    ['title'=> 'Importar Acciones Centralizadas','class'=>'btn btn-default'])
                
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'info', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Accion Centralizada Acciones Especificas listing',
                'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after'=>BulkButtonWidget::widget([
                        'buttons'=>
                            Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar',
                            ["bulk-delete"] ,
                            [
                                "class"=>"btn btn-danger btn-xs",
                                'role'=>'modal-remote-bulk',
                                'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                'data-request-method'=>'post',
                                'data-confirm-title'=>'¿Está seguro?',
                                'data-confirm-message'=>'¿Está seguro que desea eliminar los elementos seleccionados?'
                            ]).' '.
                            Html::a('<i class="glyphicon glyphicon-ban-circle"></i>&nbsp; Desactivar',
                                ["bulk-estatusdesactivo"] ,
                                [
                                    "class"=>"btn btn-warning btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'¿Está seguro?',
                                    'data-confirm-message'=>'¿Está seguro que desea desactivar los elementos seleccionados?'
                                ]).' '.
                            Html::a('<i class="glyphicon glyphicon-ok-circle"></i>&nbsp; Activar',
                                ["bulk-estatusactivo"] ,
                                [
                                    "class"=>"btn btn-success btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'¿Está seguro?',
                                    'data-confirm-message'=>'¿Está seguro que desea activar los elementos seleccionados?'
                                ]),
                    ]).



            /*'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Borrar',
                                ["bulkdelete"] ,
                                
                                ['class' => 'btn btn-danger btn-xs',
                                'onclick' => "
                                 var HotId = $(\"#especifica\").yiiGridView(\"getSelectedRows\");
                                    
                                    if(HotId==''){
                                        alert('Error, Debe Seleccionar Algun Elemento');
                                        return false;
                                    }
                                if (confirm('¿Está seguro que desea activar este elemento?')) {
                                   
                                $.ajax({
                                type: 'POST',
                                url : \"index.php?r=ac-ac-espec/bulk-delete\",
                                data : {pks: HotId},
                                }).done(function(data) {
                                $.pjax.reload({container: '#especifica-pjax'});
                                });
                                }
                                return false;
                                ",   

                                  
                                ]),
                        ]).'&nbsp;'.
                                 Html::a('<i class="glyphicon glyphicon-ban-circle"></i>&nbsp; Desactivar',
                                ["bulkEstatus"] ,
                                
                                ['class' => 'btn btn-warning btn-xs',
                                'onclick' => "
                                 var HotId = $(\"#especifica\").yiiGridView(\"getSelectedRows\");
                                    
                                    if(HotId==''){
                                        alert('Error, Debe Seleccionar Algun Elemento');
                                        return false;
                                    }
                                if (confirm('¿Está seguro que desea Desactivar este elemento?')) {
                                   
                                $.ajax({
                                type: 'POST',
                                url : \"index.php?r=ac-ac-espec/bulk-estatusdesactivo\",
                                data : {pks: HotId},
                                }).done(function(data) {
                                $.pjax.reload({container: '#especifica-pjax'});
                                });
                                }
                                return false;
                                ",   

                                
                                
                        ]).' '.
                               Html::a('<i class="glyphicon glyphicon-ban-circle"></i>&nbsp; Activar',
                                ["bulkdEstatus"] ,
                                
                                ['class' => 'btn btn-success btn-xs',
                                'onclick' => "
                                 var HotId = $(\"#especifica\").yiiGridView(\"getSelectedRows\");
                                    
                                    if(HotId==''){
                                        alert('Error, Debe Seleccionar Algun Elemento');
                                        return false;
                                    }
                                if (confirm('¿Está seguro que desea activar este elemento?')) {
                                   
                                $.ajax({
                                type: 'POST',
                                url : \"index.php?r=ac-ac-espec/bulk-estatusactivo\",
                                data : {pks: HotId},
                                }).done(function(data) {
                                $.pjax.reload({container: '#especifica-pjax'});
                                });
                                }
                                return false;
                                ",   

                                  
                                
                        ]).*/
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
 <?php  $data = [
    "1" => "1"
            ];
    $filterwidget=\kartik\select2\Select2::widget([
        'name' => 'id_ue',
        'value' => '',
        'data' => $data,
        'options' => ['multiple' => true, 'placeholder' => 'Select states ...', 'id' => 'unique-select23-id']
    ]);
    ?>