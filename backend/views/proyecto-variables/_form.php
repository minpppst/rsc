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
DepDropAsset::register($this);
/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariables */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-variables-form">

  <?php $form = ActiveForm::begin(); ?>

  <div class="panel panel-primary">

    <div class="panel-heading">
      <span>Proyecto Variables</span>
    </div>
    
    <div class="panel-body">
    
      <?= $form->field($model, 'nombre_variable')->textarea(['rows' => 2]) ?>

      <?= $form->field($model, 'unidad_medida')->dropDownList(ArrayHelper::map(UnidadMedida::find()->all(), 'id','unidad_medida'),['prompt'=>'Seleccione']) ?>

      <?= $form->field($model, 'definicion')->textarea(['rows' => 2]) ?>

      <?= $form->field($model, 'base_calculo')->textarea(['rows' => 2]) ?>

      <?= $form->field($model, 'fuente_informacion')->textarea(['rows' => 2]) ?>

      <!-- Se Agrega Los Proyectos -->
      <?= $form->field($proyecto, 'nombre')->dropDownList(ArrayHelper::map($listproyecto,'id','nombre'), ['options' => [$proyecto->id => ['Selected' => 'seleted']], 'prompt' => 'Seleccione Un Proyecto', 'id'=> 'proyecto'])->label('Proyecto');
      ?>
    
      <?= $form->field($model, 'accion_especifica')->dropDownList(ArrayHelper::map($proyectoac, 'id', 'nombre'), ['prompt' => 'Seleccione']) ?>
    
      <?= $form->field($model, 'unidad_ejecutora')->dropDownList(ArrayHelper::map($ue, 'id', 'name'), ['prompt' => 'Seleccione']) ?>

      <div>
      
        <?php 
        echo $form->field($modeluser, 'id')->widget(DepDrop::classname(),
              [
                'type'=>DepDrop::TYPE_SELECT2,
                'data' => $model->isNewRecord ? NULL : ArrayHelper::map($listausuariosaccion,'id', 'username'),
                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                'options' => ['id'=>'id_usuario', 'prompt' => 'Seleccione una Ejecutora', 'multiple' => true],
                'pluginOptions'=>
                  [
                    'depends'=>['proyectovariables-unidad_ejecutora','proyectovariables-accion_especifica'],
                    'loadingText' => 'Cargando Usuarios ...',
                    'placeholder' => 'Seleccione Usuarios...',
                    'url' => Url::to(['ace1']),
                  ]
              ])->label('Usuarios De Carga');
        ?>
      </div>
      <?= $form->field($model, 'localizacion')->dropDownList(ArrayHelper::map($lugares,'id','ambito'),['prompt'=>'Seleccione']) ?>

      <?= $form->field($model, 'impacto')->dropDownList(ArrayHelper::map($impacto, 'id', 'descripcion'), ['prompt' => 'Seleccione']) ?>
  
	    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar ', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span> Volver', ['index'], ['class' => 'btn btn-primary']) ?>
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
          $("#proyectovariables-accion_especifica").depdrop({
            depends: ["proyecto"],
            //initialize : true,
            //initDepends:["proyecto"],
            url: "'.Url::to(["ace2"]).'"
        });
        $("#proyectovariables-unidad_ejecutora").depdrop({
            depends: ["proyectovariables-accion_especifica"],
            //initialize : true,
            //initDepends:["proyectovariables-accion_especifica"],
            url: "'.Url::to(["ace"]).'"
        });

        });
        '
);
?>
