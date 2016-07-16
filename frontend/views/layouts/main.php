<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Roraima',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    /**
     * Iconos del menu
     */
    $icons=[
        'inicio'=>'<span class="glyphicon glyphicon-home" aria-hidden="true"></span>',
        'proyecto'=>'<span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span>',
        'acc'=>'<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>',
        'config'=>'<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>',
        'entrar'=>'<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>',
        'salir'=>'<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>',
        'pedido'=>'<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>',
        'asignar'=>'<span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>',
        'variable' =>'<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>',
    ];
    /*
     * Widget del menu
     */
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels'=>false,
        'items' => require(__DIR__.'/_items.php'),
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <!-- Miga de pan o Hilo de Ariadna -->
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => 'Inicio', 'url' => ['/site/index']],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; MINPPPST <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
