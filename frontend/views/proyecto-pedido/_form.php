<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoPedido */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="proyecto-pedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">

        <label>Material</label>

        <?= Select2::widget([
            'model' => $model,
            'theme' => Select2::THEME_KRAJEE,
            'name' => 'material',
            'attribute' => 'id_material',
            'data' => ArrayHelper::map($materiales,'id','nombre'),
            'options' => [
                'placeholder' => 'Escriba para buscar un material o servicio',
                'id'=>'material'
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
            'addon' => [
                'prepend' => [
                    'content' => '<span class="glyphicon glyphicon-cutlery"></span>'
                ]
            ],
            'pluginEvents' => [
            // Usar el arreglo JSON para colocar precio, iva, etc
                "select2:select" => "function() {
                    var arreglo =  ".$precios.";
                    $('#proyectopedido-precio').val(arreglo[$(this).val()]['precio']);
                    $('#iva-porcentaje').val(arreglo[$(this).val()]['iva']);
                }",
            ]
        ])?>

    </div>

    <?= $form->field($model, 'precio', [
        'inputTemplate' => '<div class="input-group"><span class="input-group-addon">Bs.</span>{input}</div>',
    ])->input('number', ['maxlength' => true, 'placeholder' => '0', 'readonly' => true]) ?>

    <?= Html::hiddenInput('iva-porcentaje', '', ['id' => 'iva-porcentaje']) ?>

    <!-- TRIMESTRES -->
    <table class="table table-bordered table-condensed table-striped">
        <tbody>
            <tr class="warning">
                <td><label>TRIM I</label></td>

                <td><?= $form->field($model, 'enero')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim1']) ?></td>

                <td><?= $form->field($model, 'febrero')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim1']) ?></td>

                <td><?= $form->field($model, 'marzo')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim1']) ?></td>

                <td><label>Total</label><input type="text" id="total1" size="5" placeholder="0" readonly></td>

            </tr>
            <tr class="info">
                <td><label>TRIM II</label></td>

                <td><?= $form->field($model, 'abril')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2']) ?></td>                           

                <td><?= $form->field($model, 'mayo')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2']) ?></td>

                <td><?= $form->field($model, 'junio')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2']) ?></td>

                <td><label>Total</label><input type="text" id="total2" size="5" placeholder="0" readonly></td>
            </tr>
            <tr class="danger">
                <td><label>TRIM III</label></td> 

                <td><?= $form->field($model, 'julio')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3']) ?></td>

                <td><?= $form->field($model, 'agosto')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3']) ?></td>

                <td><?= $form->field($model, 'septiembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3']) ?></td>

                <td><label>Total</label><input type="text" id="total3" size="5" placeholder="0" readonly></td>
            </tr>
            <tr class="success">
                <td><label>TRIM IV</label></td>

                <td><?= $form->field($model, 'octubre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4']) ?></td>

                <td><?= $form->field($model, 'noviembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4']) ?></td>

                <td><?= $form->field($model, 'diciembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4']) ?></td>

                <td><label>Total</label><input type="text" id="total4" size="5" placeholder="0" readonly></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><label>Total</label><input type="text" id="total" size="5" placeholder="0" readonly></td>
        </tbody>
    </table>

    <div class="form-group">

        <label>Sub-Total</label>

        <div class="input-group">
            <span class="input-group-addon">Bs.</span>
            <?= Html::input('text', 'sub-total','', ['id' => 'sub-total', 'placeholder' => 0, 'readonly' => true, 'class' => 'form-control']) ?>
        </div>
    </div>

    <div class="form-group">

        <label>IVA</label>

        <div class="input-group">
            <span class="input-group-addon">Bs.</span>
            <?= Html::input('text', 'iva','', ['id' => 'iva', 'placeholder' => 0, 'readonly' => true, 'class' => 'form-control']) ?>
        </div>

    </div>

    <div class="form-group">

        <label>Total</label>
        
        <div class="input-group">
            <span class="input-group-addon">Bs.</span>
            <?= Html::input('text', 'total','', ['id' => 'total-total', 'placeholder' => 0, 'readonly' => true, 'class' => 'form-control']) ?>
        </div>

    </div>

    <?= Html::activeHiddenInput($model, 'asignado') ?>

    <?= $form->field($model, 'estatus')->dropDownList([1=>'Activo',0=>'Inactivo'],['prompt'=>'Seleccione']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){

        //Totalizar
        initTotal();
        //Calcular
        calcular();

        /** EVENTOS **/

        $('#material').on('change', function(){
            initTotal();
        });

        //TRIM I
        $('.trim1').on('change', function(){
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
        $('.trim1, .trim2, .trim3, .trim4').on('change', function(){
            initTotal();
        });

        //PRECIO
        $('#proyectopedido-precio').on('change', function(){
            console.log('asdasasf');
            initTotal();
        });

        /** FUNCIONES **/

        function trim1()
        {
            $('#total1').val(
                parseInt($('#proyectopedido-enero').val())+
                parseInt($('#proyectopedido-febrero').val())+
                parseInt($('#proyectopedido-marzo').val())
            );
        }

        function trim2()
        {
            $('#total2').val(
                parseInt($('#proyectopedido-abril').val())+
                parseInt($('#proyectopedido-mayo').val())+
                parseInt($('#proyectopedido-junio').val())
            );
        }

        function trim3()
        {
            $('#total3').val(
                parseInt($('#proyectopedido-julio').val())+
                parseInt($('#proyectopedido-agosto').val())+
                parseInt($('#proyectopedido-septiembre').val())
            );
        }

        function trim4()
        {
            $('#total4').val(
                parseInt($('#proyectopedido-octubre').val())+
                parseInt($('#proyectopedido-noviembre').val())+
                parseInt($('#proyectopedido-diciembre').val())
            );
        }

        function calcular()
        {
            //variables
            var sub_total = $('#proyectopedido-precio').val() * $('#total').val();
            var iva = sub_total / 100 * $('#iva-porcentaje').val();
            var total = sub_total + iva;

            //Sub-total
            $('#sub-total').val(sub_total);

            //IVA
            $('#iva').val(iva);

            //Total
            $('#total-total').val(total);
        }

        function initTotal()
        {
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

            calcular();
        }

    });
</script>