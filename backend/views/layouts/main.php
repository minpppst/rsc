<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    <script type="text/javascript">
    /*
    /Detalle de la observacion
    */
    function feedback(id, id_observacion)
    {
      $.getJSON('/rsc/backend/web/index.php?r=feedback/find&id='+id_observacion, function(data)
      {
        $("#modalContent").html('<img src="'+ data.img +'" />');
        $("#mensaje").html('<p align="center">'+ data.mensaje +'</p>');
        //se coloca como leido
        $.get('index.php?r=notifications/notifications/read', {id: id}, function () {
            $('#grading-sys-modal').modal('show');
        });
        
      });
    }
    </script>
    </head>
    <body class="<?= \dmstr\helpers\AdminLteHelper::skinClass() ?> sidebar-mini">
    <?php $this->beginBody() ?>
    <div><img src="img/cintillo.jpg" width="100%;" height="50px;" ></div>
    <div class="wrapper">


        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <div class="wrap">
            <?= $this->render(
                'content.php',
                ['content' => $content, 'directoryAsset' => $directoryAsset]
            ) ?>
        </div>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>

<?php
  yii\bootstrap\Modal::begin([
    'id'=>'grading-sys-modal', 
    'header' => '<h2>Detalle de la Observaci&oacute;n</h2>',
    'size' => 'modal-lg',
    'closeButton' => ['id' => 'close-button'],
    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]),
  ]);
   echo 
    "
        <div id='modalContent' style='overflow: scroll';>
            <img id='imgFromScript'  style='max-width: auto;' src='#'  alt=''/>
        </div>
        <h3><p align='center'>Observaci&oacute;n</p></h3>
        <div id='mensaje'></div>
    ";
   yii\bootstrap\Modal::end();
?>