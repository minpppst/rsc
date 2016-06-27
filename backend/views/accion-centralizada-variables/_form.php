<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use kartik\depdrop\DepDropAsset;
use common\models\UnidadMedida;
use common\models\UnidadEjecutora;
use common\models\Ambito;
use yii\web\view;
use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAsignar */
/* @var $form yii\widgets\ActiveForm */
DepDropAsset::register($this);
// Register the formatting script

 
// script to parse the results into the format expected by Select2
$url = \yii\helpers\Url::to(['ace1']);
 $dataResults = <<< SCRIPT
  function resultado (params) {
    var id=\$("#accioncentralizadavariables-unidad_ejecutora").val();
    if(id!="")
   return {q:params.term, id:id}; 
  
 
 } 
SCRIPT;
$this->registerJs($dataResults, yii\web\View::POS_HEAD);




?>

<div class="accion-centralizada-variables-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
    
    <div class="panel-heading">
         <span>Acción Centralizada Variables</span>
    </div>
    
    <div class="panel-body">
    
    <?= $form->field($model, 'nombre_variable')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'unidad_medida')->dropDownList(ArrayHelper::map(UnidadMedida::find()->all(), 'id','unidad_medida'),['prompt'=>'Seleccione']) ?>

    <?= $form->field($model, 'definicion')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'base_calculo')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'fuente_informacion')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'unidad_ejecutora')->dropDownList(ArrayHelper::map(UnidadEjecutora::find()->all(), 'id','nombre'), ['prompt'=> 'Selecciones Unidad Ejecutora',]) ?>
<?php if(empty($acciones_especificas))
  $acciones_especificas=[];
  ?>
  


    <?= $form->field($model, 'acc_accion_especifica')->dropDownList($acciones_especificas,  ['prompt' => 'Seleccione']) ?>
     <div>
    <label class="control-label" for="acespuej-id_ue">Usuarios De Carga</label>
   <?php if(empty($precarga)){
    $precarga=NULL;
  };
  if(empty($precarga1)){
    $precarga1=NULL;
  };
  
    
  echo \kartik\select2\Select2::widget([
    'name' => 'id_usuario',
    'id' => 'id_usuario',
    'value' =>  $precarga,
    'initValueText' => $precarga1,
    'options' => ['placeholder' => 'Seleccionar Usuario Responsable ...', 'multiple' => true, 'language' => 'es', ],
    'pluginOptions' => [
         'allowClear' => true,
         'ajax' => [
            'url' => $url,
            'data' => new JsExpression($dataResults),
         ],
          
          'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
          'templateResult' => new JsExpression('function(id_usuario) { return id_usuario.name; }'),
          'templateSelection' => new JsExpression('function (id_usuario) {  if(id_usuario.name === undefined) return id_usuario.text; else return id_usuario.name;  }'), 
                 
        ],
]);
  
  
?>
    </div>
    <?php  $lugares =[ ['id' => '0', 'nombre' => 'Nacional'], ['id' => '1', 'nombre' => 'Estadal'], ];?>
    <?= $form->field($model, 'localizacion')->dropDownList(ArrayHelper::map($lugares,'id','nombre'),['prompt'=>'Seleccione']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
     </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
 

<?php


$this->registerJs(
   
    /* Listas desplegables dependientes */
      '$("document").ready(function(){
        //GE

        $("#accioncentralizadavariables-acc_accion_especifica").depdrop({
            depends: ["accioncentralizadavariables-unidad_ejecutora"],
            url: "'.Url::to(["ace"]).'"
        });
        $("#accioncentralizadavariables-unidad_ejecutora").on("change", function(){
        $("#accioncentralizadavariables-acc_accion_especifica").empty();
        
        //$("#id_usuario").html("").select2({data: null});
        $("#id_usuario").select2("val", "");
        
        
        
        
    });


        });
     
        '
);
?>


