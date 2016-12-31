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
      <?= $form->field($modelAC, 'nombre_accion')->dropDownList(ArrayHelper::map($listaaccion_centralizada,'id','nombre_accion'), ['options' => [$modelAC->id => ['Selected' => 'seleted']],'prompt' => 'Seleccione Una Acción', 'id'=> 'accion_centralizada'])->label('Acción Centralizada');
      ?>
    
      <?= $form->field($model, 'acc_accion_especifica')->dropDownList(ArrayHelper::map($listaaccion_especifica, 'id', 'nombre'), ['prompt' => 'Seleccione']) ?>
    
      <?= $form->field($model, 'unidad_ejecutora')->dropDownList(ArrayHelper::map($ue, 'id', 'name'), ['prompt' => 'Seleccione']) ?>

      <div>
      
        <?php
        echo $form->field($usuariomodel, 'id')->widget(DepDrop::classname(),
              [
                'type'=>DepDrop::TYPE_SELECT2,
                'data' => $model->isNewRecord ? NULL : ArrayHelper::map($listausuarios,'id', 'username'),
                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                'options' => ['id'=>'id_usuario', 'prompt' => 'Seleccione una Ejecutora', 'multiple' => true],
                'pluginOptions'=>
                  [
                    'depends'=>['accioncentralizadavariables-unidad_ejecutora','accioncentralizadavariables-acc_accion_especifica'],
                    'loadingText' => 'Cargando Usuarios ...',
                    'placeholder' => 'Seleccione Usuarios...',
                    'url' => Url::to(['ace1']),
                  ]
              ])->label('Usuarios De Carga');
        ?>
      </div>
      
      <?= $form->field($model, 'localizacion')->dropDownList(ArrayHelper::map($lugares,'id','ambito'),['prompt'=>'Seleccione']) ?>

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
        });
        $("#accioncentralizadavariables-acc_accion_especifica").on("change", function(){
        });
        $("#accioncentralizadavariables-unidad_ejecutora").on("change", function(){
        });
        });
        '
);
?>
