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
 $initScript =  <<< SCRIPT
         
            function nombre  (element, callback) {
            
           var id=\$("#accioncentralizadavariables-unidad_ejecutora").val();
           $.ajax({
           url: "$url",
           type: 'post',
           data: {q: id},
           success: function (data) {
              for(var i = 0; i < data.length; i++){
                 data[i]={id:i,text:data[i].text}
             }
               return data

           }

      });

            }

SCRIPT;

$this->registerJs($initScript, View::POS_HEAD);


$initprecarga =  <<< SCRIPT
           function precarga (element, callback) {

       var search=\$(element).val();
       if(search!=null){

       
       search=search.toString();

        var id=\$("#accioncentralizadavariables-unidad_ejecutora").val();
        if (search !== "") {
            \$.ajax({
            url: "$url",
           
            data: {id: id, q: search},
            dataType: "json"
            }).done(function(data) { 
                  
                    callback(data.results);

        });
        }
      }
        }

SCRIPT;
$this->registerJs($initprecarga, View::POS_HEAD);

$dataResults = <<< SCRIPT
  function resultado (params) {
    var id=\$("#accioncentralizadavariables-unidad_ejecutora").val();
    if(id!="")
   return {q:params.term, id:id}; 
 }
SCRIPT;

//$selection = explode(",", $precarga);
//$js="function probando() {";
//$js .= "var id_usuario1 = document.getElementById('id_usuario');";
//foreach ($selection as $val) {
    //$js .= "$('#w0 option[value=". $val ."]').attr('selected','selected').change();";
  //$js.="$('#id_usuario').select2('data', {id: 2, a_key: 'Lorem Ipsum'});";
  //$js .=" $('#id_usuario option[value=' + 3 + ']').prop('selected', true); ";
  //$js.="$('#id_usuario').select2('data', {id: results.prospect_id, text: results.prospect_nome});";
//} //$("#mySelect").select2();
//$js.="$('#id_usuario').select2().val('2').trigger('change')";
  //$js.="$('#id_usuario').select2();";
 // $js.="$('#id_usuario').val('2').select2();";
  //$js.="$('#id_usuario').select2('2','Lorem Ipsum');";
//$js.=" }";

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

    <?= $form->field($model, 'unidad_ejecutora')->dropDownList(ArrayHelper::map(UnidadEjecutora::find()->all(), 'id','nombre') , ['onChange'=> ' nombre(this.value, 2)']) ?>

    <?= $form->field($model, 'acc_accion_especifica')->dropDownList([],  ['prompt' => 'Seleccione']) ?>
     <div>
    <label class="control-label" for="acespuej-id_ue">Usuarios De Carga</label>
   <?php if(empty($precarga)){
    $precarga=NULL; 
  };
  //print_r($precarga); exit();

    
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
            //'data' => new JsExpression('function(params) { return {q:params.term}; }'),
           // 'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
            //'results' => new JsExpression($js),
            ],
          
          'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
          'templateResult' => new JsExpression('function(id_usuario) { return id_usuario.name; }'),
          'templateSelection' => new JsExpression('function (id_usuario) {  if(id_usuario.name === undefined) return id_usuario.text; else return id_usuario.name;  }'), 
          //'initSelection' => new JsExpression($initprecarga),

         //'initSelection' => new JsExpression($js),        
        
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
    //'$("document").ready(function(){ alert("hi"); });'

    /* Listas desplegables dependientes */
    '$("document").ready(function(){
        //GE

        $("#accioncentralizadavariables-acc_accion_especifica").depdrop({
            depends: ["accioncentralizadavariables-unidad_ejecutora"],
            url: "'.Url::to(["ace"]).'"
        });
        
        /*function  nombre(element, callback) {
            alert(ssss);
                var id=$("#accioncentralizadavariables-acc_accion_especifica").val();
                if (id !== "") {
                    
                    $.ajax({

                        type : POST,
                        url : {$url},
                        dataType: "json",
                         data : {"id" :id }

                    });//.done(function(data) { callback(data.results);});
                }
            }*/


        
        
    });'
);
?>


