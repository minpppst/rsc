<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="img/no-photo.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    //CONTROL DE ACCESO
                    //Header
                    ['label' => 'Control de Acceso', 'options' => ['class' => 'header']],
                    //Items
                    ['label' => 'Usuarios', 'icon' => 'fa fa-user', 'url' => ['/user/manager']],
                    ['label' => 'Roles', 'icon' => 'fa fa-asterisk', 'url' => ['/rbac/role']],
                    ['label' => 'Permisos', 'icon' => 'fa fa-lock', 'url' => ['/rbac/permission']],
                    ['label' => 'Reglas', 'icon' => 'fa fa-eye', 'url' => ['/rbac/rule']],

                    //ASIGNACIONES
                    //Header
                    ['label' => 'Asignaciones', 'options' => ['class' => 'header']],
                    //Items
                    ['label' => 'Proyecto', 'icon' => 'fa fa-folder', 'url' => ['/proyecto-asignar/index']],
                    ['label' => 'Acción Centralizada', 'icon' => 'fa fa-tasks', 'url' => ['/accion-centralizada-asignar/index']],

                    //PEDIDOS
                    ['label' => 'Pedidos/Solicitudes', 'options' => ['class' => 'header']],
                    //Items
                    ['label' => 'Proyecto pedido', 'icon' => 'fa fa-shopping-cart ', 'url' => ['/proyecto-pedido/index']],
                    ['label' => 'Acción Centralizada pedido', 'icon' => 'fa fa-shopping-basket ', 'url' => ['/accion-centralizada-pedido/index']],

                    //PROPIEDADES
                    //Header
                    ['label' => 'Propiedades', 'options' => ['class' => 'header']],
                    //Items                    
                    [
                        'label' => 'Partidas', 
                        'icon' => 'glyphicon glyphicon-list-alt', 
                        'url' => '#',
                        'items' => [
                            ['label' => 'Partida', 'icon' => 'glyphicon glyphicon-list-alt', 'url' => ['/partida-partida/index'],],
                            ['label' => 'Genérica', 'icon' => 'glyphicon glyphicon-tree-deciduous', 'url' => ['/partida-generica/index'],],
                            ['label' => 'Específica', 'icon' => 'glyphicon glyphicon-tree-conifer', 'url' => ['/partida-especifica/index'],],
                            ['label' => 'Sub-específica', 'icon' => 'glyphicon glyphicon-leaf', 'url' => ['/partida-sub-especifica/index'],],
                        ]

                    ],
                    [
                        'label' => 'Objetivos',
                        'icon' => 'glyphicon glyphicon-screenshot',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Históricos', 'icon' => 'glyphicon glyphicon-time', 'url' => ['/objetivos-historicos/index'],],
                            ['label' => 'Nacionales', 'icon' => 'glyphicon glyphicon-map-marker', 'url' => ['/objetivos-nacionales/index'],],
                            ['label' => 'Estratégicos', 'icon' => 'glyphicon glyphicon-knight', 'url' => ['/objetivos-estrategicos/index'],],
                            ['label' => 'Generales', 'icon' => 'glyphicon glyphicon-star', 'url' => ['/objetivos-generales/index'],],
                        ]
                    ],
                    [
                        'label' => 'Unidades Ejecutoras', 
                        'icon' => 'glyphicon glyphicon-briefcase', 
                        'url' => '#',
                        'items' => [
                            ['label' => 'Lista', 'icon' => 'glyphicon glyphicon-th-list', 'url' => ['/unidad-ejecutora/index'],],
                            ['label' => 'Importar', 'icon' => 'glyphicon glyphicon-import', 'url' => ['/unidad-ejecutora/importar'],],                                    
                        ]

                    ],
                    ['label' => 'Unidades de Medida', 'icon' => 'glyphicon glyphicon-scale', 'url' => ['/unidad-medida/index']],
                    ['label' => 'Presentaciones', 'icon' => 'glyphicon glyphicon-blackboard', 'url' => ['/presentacion/index']],
                    [
                        'label' => 'Materiales y Servicios', 
                        'icon' => 'glyphicon glyphicon-cutlery',
                        'items' => [
                            ['label' => 'Lista', 'icon' => 'glyphicon glyphicon-th-list', 'url' => ['/materiales-servicios/index']],
                            ['label' => 'Importar', 'icon' => 'glyphicon glyphicon-import', 'url' => ['/materiales-servicios/importar']]
                        ]
                    ],
                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],                    
                ],
            ]
        ) ?>

    </section>

</aside>
