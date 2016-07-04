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
    var acc=\$("#accioncentralizadavariables-acc_accion_especifica").val();
    if(id!="")
   return {q:params.term, id:id, acc:acc,}; 
  
 
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

    <!-- Se Agrega La Acciones Centralizadas -->
     <label class="control-label">Acción Centralizada</label>
    <?php if(!$model->isNewRecord){ ?>
    
    <?= Html::dropDownList('accion_centralizada','accion_centralizada',ArrayHelper::map($accion_centralizada,'id','nombre_accion'),
    ['options' => [$accion_especifica[0]->id_ac_centr => ['Selected' => 'seleted']], 'class' => 'form-control', 'id' => 'accion_centralizada'])?>
    
    <?php }
    
    else{ ?>
    
    <?= Html::dropDownList('accion_centralizada','accion_centralizada',ArrayHelper::map($accion_centralizada,'id','nombre_accion'),
    ['prompt' => 'Seleccione', 'class' => 'form-control', 'id' => 'accion_centralizada'])?>
    
    <?php
    } // fin del else
    ?>
    
    
    <?= $form->field($model, 'acc_accion_especifica')->dropDownList(ArrayHelper::map($accion_especifica, 'id', 'nombre'), ['prompt' => 'Seleccione']) ?>
    
    <!--<?= $form->field($model, 'unidad_ejecutora')->dropDownList(ArrayHelper::map(UnidadEjecutora::find()->all(), 'id','nombre'), ['prompt'=> 'Selecciones Unidad Ejecutora',]) ?>-->
    
    <?= $form->field($model, 'unidad_ejecutora')->dropDownList(ArrayHelper::map($ue, 'id', 'name'), ['prompt' => 'Seleccione']) ?>

    <?php if(empty($acciones_especificas))
    $acciones_especificas=[];
    ?>
  
    <!--<?= $form->field($model, 'acc_accion_especifica')->dropDownList($acciones_especificas,  ['prompt' => 'Seleccione']) ?>-->
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
            depends: ["accion_centralizada"],
            url: "'.Url::to(["ace2"]).'"
        });

        $("#accioncentralizadavariables-unidad_ejecutora").depdrop({
            depends: ["accioncentralizadavariables-acc_accion_especifica"],
            url: "'.Url::to(["ace"]).'"
        });

        $("#accion_centralizada").on("change", function(){
        $("#id_usuario").select2("val", "");
        });
        
        $("#accioncentralizadavariables-acc_accion_especifica").on("change", function(){
        $("#id_usuario").select2("val", "");
        });
        
        $("#accioncentralizadavariables-unidad_ejecutora").on("change", function(){
        $("#id_usuario").select2("val", "");
        });


        });
     
        '
);
?>


