<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\depdrop\DepDropAsset;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
DepDropAsset::register($this);
/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariableLocalizacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-variable-localizacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    switch ($model->scenario)
        {
            case 'Internacional':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($pais,'id','nombre'),['prompt'=>'Seleccione'], ['disabled' => 'disabled']);
            break;

            case 'Nacional':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($pais,'id','nombre'),['prompt'=>'Seleccione'], ['disabled' => 'disabled']);
            break;

            case 'Estadal':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($pais,'id','nombre'),['prompt'=>'Seleccione', 'disabled' => true]);
                echo $form->field($model, 'id_estado')->dropDownList(ArrayHelper::map($estados,'id','nombre'),['prompt'=>'Seleccione']);
            break;

            case 'Municipal':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($pais,'id','nombre'),['prompt'=>'Seleccione', 'disabled' => true]);
                
                echo $form->field($model, 'id_estado')->dropDownList(ArrayHelper::map($estados,'id','nombre'),['prompt'=>'Seleccione', 'id' => 'id_estado']);

                echo $form->field($model, 'id_municipio')->dropDownList(ArrayHelper::map($municipios,'id','nombre'),['prompt'=>'Seleccione', 'id' => 'id_municipio']);

            break;

            case 'Parroquial':
                
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($pais,'id','nombre'),['prompt'=>'Seleccione', 'disabled' => true]);

                echo $form->field($model, 'id_estado')->dropDownList(ArrayHelper::map($estados,'id','nombre'),['prompt'=>'Seleccione', 'id' => 'id_estado']);

                echo $form->field($model, 'id_municipio')->dropDownList(ArrayHelper::map($municipios,'id','nombre'),['prompt'=>'Seleccione', 'id' => 'id_municipio']);
                
                echo $form->field($model, 'id_parroquia')->dropDownList(ArrayHelper::map($parroquias,'id','nombre'),['prompt'=>'Seleccione', 'id' => 'id_parroquia']);
                
            break;


            default:
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($pais,'id','nombre'),['prompt'=>'Seleccione'], ['disabled' => 'disabled']);
            break;
        }
    ?>
    <br>
    <div style='width: 550px'>
        <table class="table table-bordered table-condensed table-striped">
            <tbody>
                <tr class="warning">
                    <td><label>TRIM I</label></td>
                
                    <td><?= $form->field($model1, 'enero')->input('number', ['style' => 'max-width:100px',  'placeholder' => '0', 'class' => 'trim1' ])->label('Enero', ['style' => 'display: block;']) ?></td>
                
                    <td><?= $form->field($model1, 'febrero')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim1' ])->label('Febrero', ['style' => 'display: block;']) ?></td>

                    <td><?= $form->field($model1, 'marzo')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim1' ])->label('Marzo', ['style' => 'display: block;']) ?></td>

                    <td><label>Total</label><br><input type="text" id="total1" size="5" placeholder="0" readonly ></td>
                </tr> 
                <tr class="info">
                    <td><label>TRIM II</label></td>

                    <td><?= $form->field($model1, 'abril')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2'])->label('Abril', ['style' => 'display: block;']) ?></td>                           

                    <td><?= $form->field($model1, 'mayo')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2'])->label('Mayo', ['style' => 'display: block;']) ?></td>

                    <td><?= $form->field($model1, 'junio')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2'])->label('Junio', ['style' => 'display: block;']) ?></td>

                    <td><label>Total</label><br><input type="text" id="total2" size="5" placeholder="0" readonly ></td>
                </tr>
                <tr class="danger">
                    <td><label>TRIM III</label></td> 

                    <td><?= $form->field($model1, 'julio')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3'])->label('Julio', ['style' => 'display: block;']) ?></td>

                    <td><?= $form->field($model1, 'agosto')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3'])->label('Agosto', ['style' => 'display: block;']) ?></td>

                    <td><?= $form->field($model1, 'septiembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3'])->label('Septiembre', ['style' => 'display: block;']) ?></td>

                    <td><label>Total</label><br><input type="text" id="total3" size="5" placeholder="0" readonly></td>
                </tr>
                <tr class="success">
                    <td><label>TRIM IV</label></td>

                    <td><?= $form->field($model1, 'octubre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4' ])->label('Octubre', ['style' => 'display: block;']) ?></td>

                    <td><?= $form->field($model1, 'noviembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4' ])->label('Noviembre', ['style' => 'display: block;']) ?></td>

                    <td><?= $form->field($model1, 'diciembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4' ])->label('Diciembre', ['style' => 'display: block;']) ?></td>

                    <td><label>Total</label><br><input type="text" id="total4" size="5" placeholder="0" readonly></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><label>Total</label><br><input type="text" id="total" size="5" placeholder="0" readonly></td>
                </tr>
            </tbody>
        </table>
    </div>
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){

        initTotal();

        //TRIM I
        $('.trim1').on('key', function(){
            initTotal();
        });
        //TRIM II
        $('.trim2').on('change', function(){
            initTotal();
        });
        //TRIM III
        $('.trim3').on('change', function(){
            initTotal();
        });
        //TRIM IV
        $('.trim4').on('change', function(){
            initTotal();
        });

        //TOTAL
        $('.trim1, .trim2, .trim3, .trim4').on('keyup', function(){
            initTotal();
        });
        
       function trim1()
        {
        $('#total1').val(
        (Number($('#proyectovariableprogramacion-enero').val()) ? parseInt($('#proyectovariableprogramacion-enero').val()) : 0)+
        (Number($('#proyectovariableprogramacion-febrero').val()) ? parseInt($('#proyectovariableprogramacion-febrero').val()) : 0)+
        (Number($('#proyectovariableprogramacion-marzo').val()) ? parseInt($('#proyectovariableprogramacion-marzo').val()) : 0)
        );
        
        }

        //TRIM II
          function trim2()
        {
        $('#total2').val(
        (Number($('#proyectovariableprogramacion-abril').val()) ? parseInt($('#proyectovariableprogramacion-abril').val()) : 0)+
        (Number($('#proyectovariableprogramacion-mayo').val())  ? parseInt($('#proyectovariableprogramacion-mayo').val()) : 0)+
        (Number($('#proyectovariableprogramacion-junio').val()) ? parseInt($('#proyectovariableprogramacion-junio').val()) : 0)
        );
        }

        //TRIM III
        function trim3()
        {
        $('#total3').val(
        (Number($('#proyectovariableprogramacion-julio').val()) ? parseInt($('#proyectovariableprogramacion-julio').val()) : 0)+
        (Number($('#proyectovariableprogramacion-agosto').val()) ? parseInt($('#proyectovariableprogramacion-agosto').val()) : 0)+
        (Number($('#proyectovariableprogramacion-septiembre').val()) ? parseInt($('#proyectovariableprogramacion-septiembre').val()) : 0)
        );
        }

        //TRIM IV
        function trim4()
        {
            $('#total4').val(
        (Number($('#proyectovariableprogramacion-octubre').val()) ? parseInt($('#proyectovariableprogramacion-octubre').val()) : 0)+
        (Number($('#proyectovariableprogramacion-noviembre').val()) ? parseInt($('#proyectovariableprogramacion-noviembre').val()) : 0)+
        (Number($('#proyectovariableprogramacion-diciembre').val()) ? parseInt($('#proyectovariableprogramacion-diciembre').val()) : 0)
        );
        }
            function initTotal(){

            trim1();
            trim2();
            trim3();
            trim4();

             $('#total').val(
                parseInt($('#total1').val())+
                parseInt($('#total2').val())+
                parseInt($('#total3').val())+
                parseInt($('#total4').val())
            );
            }

    });
</script>
<?php
$this->registerJs(
   
    /* Listas desplegables dependientes */
      '$("document").ready(function(){
        //GE
          $("#id_municipio").depdrop({
            depends: ["id_estado"],
            initialize : true,
            initDepends:["id_estado"],
            url: "'.Url::to(["estadomunicipios"]).'"
        });
        $("#id_parroquia").depdrop({
            depends: ["id_municipio"],
            initialize : true,
            initDepends:["id_municipio"],
            url: "'.Url::to(["municipiosparroquias"]).'"
        });
        
        });
        '
);
?>