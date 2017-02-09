<?php
use yii\helpers\Html;
use machour\yii2\notifications\widgets\NotificationsWidget;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<!-- NOTIFICACIONES -->
<?php 
    NotificationsWidget::widget([
        'theme' => NotificationsWidget::THEME_GROWL,
        'pollInterval' => 10000,
        'clientOptions' => [
            'location' => 'es',
        ],
        'counters' => [
            '.notifications-header-count',
            '.notifications-icon-count'
        ],
        'listSelector' => '#notifications',
        //Template para las notificaciones
        'listItemTemplate' => '
            <div class="row">
                <div class="col-xs-10">
                    <div class="title">{title}</div>
                    <small>{description}</small>
                    <div class="timeago">
                        <div class="notification-timeago">{timeago}</div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="actions pull-right">
                        <span class="notification-seen fa fa-check" title="Marcar como visto"></span>
                        <!--<span class="notification-delete fa fa-close" title="Eliminar notificación"></span>-->
                    </div>
                </div>
            </div>'
        
    ]);
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']); ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-danger notifications-icon-count">0</span>
                    </a>
                    <ul class="dropdown-menu" style="overflow-y: auto; overflow-x: hidden; max-height: 400px;">
                        <li class="header">Tienes <span class="notifications-header-count">0</span> notificaciones</li>
                        <li>
                            <div id="notifications"></div>
                        </li>
                        <li class="header"><?= Html::a(
                                    'Ver Todas ('.Yii::$app->user->identity->username.')',
                                    ['/notification/index'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ); ?>
                        </li>
                    </ul>
                </li>                
                
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="img/no-photo.png" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?= Yii::$app->user->identity->username; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="img/no-photo.png" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?= Yii::$app->user->identity->username; ?>
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ); ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <!--<li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>-->
            </ul>
        </div>
    </nav>
</header>
