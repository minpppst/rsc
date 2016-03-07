<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use johnitvn\ajaxcrud\CrudAsset;
use kartik\select2\Select2;
use kartik\select2\Select2Asset;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioUe */
/* @var $form yii\widgets\ActiveForm */

Select2Asset::register($this);
?>

<div class="usuario-ue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::hiddenInput('AsignarUe[usuarioId]', $formModel->usuarioId)?>    
    
    <div class="form-group">
        <label class="control-label" for="select2">Unidades Ejecutoras</label>
        <?= Select2::widget([
                'name' => 'AsignarUe[unidadesEjecutoras]',
                'value' => ArrayHelper::map($formModel->idUnidadesEjecutoras,'id', 'unidad_ejecutora'),
                'data' => ArrayHelper::map($ue,'id','nombre'),
                'maintainOrder' => true,
                'options' => [
                    'id' => 'select2',
                    'multiple' => true,
                    'class' => 'form-control'
                ],
                'pluginOptions' => [
                    'tags' => true,
                ],
                'toggleAllSettings' => [
                    'selectLabel' => '<i class="glyphicon glyphicon-ok-circle"></i> Tag All',
                    'unselectLabel' => '<i class="glyphicon glyphicon-remove-circle"></i> Untag All',
                    'selectOptions' => ['class' => 'text-success'],
                    'unselectOptions' => ['class' => 'text-danger'],
                ],
            ]);
        ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#select2").select2({
            placeholder: 'Escriba para buscar',
            allowClear: true,
            tags: true,
        });
        $('.select2, .select2-search__field').css('width','100%');
    });
</script>