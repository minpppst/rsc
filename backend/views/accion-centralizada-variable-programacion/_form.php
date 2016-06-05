<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\depdrop\DepDropAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\AccionCentralizadaVariableProgramacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accion-centralizada-variable-programacion-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?= $form->field($model, 'id_localizacion')->hiddenInput()->label(false); ?>
<div style='width: 800px'>
    <table class="table table-bordered table-condensed table-striped">
        <tbody>
            <tr class="warning">
                <td><label>TRIM I</label></td>
            
                <td><?= $form->field($model, 'enero')->input('number', ['style' => 'max-width:100px',  'placeholder' => '0', 'class' => 'trim1' ])->label('Enero', ['style' => 'display: block;']) ?></td>
            
                <td><?= $form->field($model, 'febrero')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim1' ])->label('Febrero', ['style' => 'display: block;']) ?></td>

                <td><?= $form->field($model, 'marzo')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim1' ])->label('Marzo', ['style' => 'display: block;']) ?></td>

                <td><label>Total</label><br><input type="text" id="total1" size="5" placeholder="0" readonly ></td>
            </tr> 
            <tr class="info">
                <td><label>TRIM II</label></td>

                <td><?= $form->field($model, 'abril')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2'])->label('Abril', ['style' => 'display: block;']) ?></td>                           

                <td><?= $form->field($model, 'mayo')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2'])->label('Mayo', ['style' => 'display: block;']) ?></td>

                <td><?= $form->field($model, 'junio')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2'])->label('Junio', ['style' => 'display: block;']) ?></td>

                <td><label>Total</label><br><input type="text" id="total2" size="5" placeholder="0" readonly ></td>
            </tr>
            <tr class="danger">
                <td><label>TRIM III</label></td> 

                <td><?= $form->field($model, 'julio')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3'])->label('Julio', ['style' => 'display: block;']) ?></td>

                <td><?= $form->field($model, 'agosto')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3'])->label('Agosto', ['style' => 'display: block;']) ?></td>

                <td><?= $form->field($model, 'septiembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3'])->label('Septiembre', ['style' => 'display: block;']) ?></td>

                <td><label>Total</label><br><input type="text" id="total3" size="5" placeholder="0" readonly></td>
            </tr>
            <tr class="success">
                <td><label>TRIM IV</label></td>

                <td><?= $form->field($model, 'octubre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4' ])->label('Octubre', ['style' => 'display: block;']) ?></td>

                <td><?= $form->field($model, 'noviembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4' ])->label('Noviembre', ['style' => 'display: block;']) ?></td>

                <td><?= $form->field($model, 'diciembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4' ])->label('Diciembre', ['style' => 'display: block;']) ?></td>

                <td><label>Total</label><br><input type="text" id="total4" size="5" placeholder="0" readonly></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><label>Total</label><br><input type="text" id="total" size="5" placeholder="0" readonly></td>
        </tbody>
        
    </table>
</div>




   <!-- <?= $form->field($model, 'enero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'febrero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marzo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abril')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mayo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'junio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'julio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agosto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'septiembre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'octubre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noviembre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diciembre')->textInput(['maxlength' => true]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$this->registerJs(
    //'$("document").ready(function(){ alert("hi"); });'


    "jQuery(document).ready(function(){


        //llenar campo precio
        
        $('#material').change(function(){
         $.ajax({
        url: \"'<?= Url::to(['llenarprecio']) ?>'\",
        type: 'post',
        dataType: 'json',
        data: {
           id: $('#material').val()
         },
        success: function (data) {
            if(data!=0){
            $('#accioncentralizadavariableprogramacion-precio').val(parseFloat(data[0]['precio']));
            $('#iva_precio').val(parseFloat(data[0]['iva']));
            
            }
            else{
            $('#accioncentralizadavariableprogramacion-precio').val(parseFloat(0));
                    }
    
                    }
                });
            });


       if($('#iva_precio').val()=='' && $('#material').val()!='' ){ 
        
        $.ajax({
                url: \"'<?= Url::to(['llenarprecio']) ?>'\",
                type: 'post',
                dataType: 'json',
                data: {
                id: $('#material').val()
                },
                success: function (data) {
                $('#iva_precio').val(parseFloat(data[0]['iva']));

                //Totalizar
                initTotal();
                //Calcular
                calcular();
                        
                    }
                
            });
            }

        
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
        




       function trim1()
        {
        $('#total1').val(
        (Number($('#accioncentralizadavariableprogramacion-enero').val()) ? parseInt($('#accioncentralizadavariableprogramacion-enero').val()) : 0)+
        (Number($('#accioncentralizadavariableprogramacion-febrero').val()) ? parseInt($('#accioncentralizadavariableprogramacion-febrero').val()): 0)+
        (Number($('#accioncentralizadavariableprogramacion-marzo').val()) ? parseInt($('#accioncentralizadavariableprogramacion-marzo').val()) : 0)
         );
        
        }


        //TRIM II
          function trim2()
        {
        $('#total2').val(
        (Number($('#accioncentralizadavariableprogramacion-abril').val()) ? parseInt($('#accioncentralizadavariableprogramacion-abril').val()) : 0) +
        (Number($('#accioncentralizadavariableprogramacion-mayo').val())  ? parseInt($('#accioncentralizadavariableprogramacion-mayo').val()) : 0) +
        (Number($('#accioncentralizadavariableprogramacion-junio').val()) ? parseInt($('#accioncentralizadavariableprogramacion-junio').val()) : 0)
            );
        }



        //TRIM III
        function trim3()
        {
        $('#total3').val(
        (Number($('#accioncentralizadavariableprogramacion-julio').val()) ? parseInt($('#accioncentralizadavariableprogramacion-julio').val()) : 0)+
        (Number($('#accioncentralizadavariableprogramacion-agosto').val()) ? parseInt($('#accioncentralizadavariableprogramacion-agosto').val()) : 0)+
        (Number($('#accioncentralizadavariableprogramacion-septiembre').val()) ? parseInt($('#accioncentralizadavariableprogramacion-septiembre').val()) : 0)
            );
        }

        //TRIM IV
        function trim4()
        {
            $('#total4').val(
        (Number($('#accioncentralizadavariableprogramacion-octubre').val()) ? parseInt($('#accioncentralizadavariableprogramacion-octubre').val()) : 0)+
        (Number($('#accioncentralizadavariableprogramacion-noviembre').val()) ? parseInt($('#accioncentralizadavariableprogramacion-noviembre').val()) : 0)+
        (Number($('#accioncentralizadavariableprogramacion-diciembre').val()) ? parseInt($('#accioncentralizadavariableprogramacion-diciembre').val()) : 0)
            );
        }




             function calcular()
        {
            //variables
            
            var iva_precio=(Number($('#iva_precio').val()) ? $('#iva_precio').val() : 0 );
            var sub_total = $('#accioncentralizadavariableprogramacion-precio').val() * $('#total').val();
            var iva = (sub_total  * iva_precio) / 100;
            var total = sub_total + iva;


            //Sub-total
            $('#subtotal').val(sub_total);

            //IVA
            $('#iva').val(iva);

            //Total
            $('#total-total').val(total);
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

            calcular();


            }


            });");


?>
