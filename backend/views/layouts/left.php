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
                <input type="text" name="q" class="form-control" placeholder="Buscar..."/>
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
                    ['label' => 'Permisos', 'icon' => 'fa fa-key', 'url' => ['/rbac/permission']],
                    ['label' => 'Reglas', 'icon' => 'fa fa-eye', 'url' => ['/rbac/rule']],

                    //PROYECTO Y ACC
                    //Header
                    ['label' => 'Proyectos y Acciones Centralizadas', 'options' => ['class' => 'header']],
                    //Items
                    ['label' => 'Proyecto', 'icon' => 'fa fa-folder', 'url' => ['/proyecto/index']],
                    ['label' => 'Acción Centralizada', 'icon' => 'fa fa-folder-open', 'url' => ['/accion-centralizada/index']],  

                    //ASIGNACIONES
                    //Header
                    ['label' => 'Asginar Usuarios', 'options' => ['class' => 'header']],
                    //Items
                    ['label' => 'Asignar a proyecto', 'icon' => 'fa fa-folder-o', 'url' => ['/proyecto-usuario-asignar/index']],
                    ['label' => 'Asignar a acción centralizada', 'icon' => 'fa fa-folder-open-o', 'url' => ['/accion-centralizada-asignar/index']],                 

                    //PEDIDOS
                    //Header
                    ['label' => 'Requerimientos/Solicitudes', 'options' => ['class' => 'header']],
                    //Items                    
                    ['label' => 'Proyecto requerimiento', 'icon' => 'fa fa-shopping-cart ', 'url' => ['/proyecto-pedido/index']],
                    ['label' => 'ACC requerimiento', 'icon' => 'fa fa-shopping-basket ', 'url' => ['/accion-centralizada-pedido/index']],
                    //Variables
                    ['label' => 'Variables', 'options' => ['class' => 'header']],
                    //Items
                    ['label' => 'Proyecto', 'icon' => 'fa fa-calendar-check-o', 'url' => ['/proyecto-variables/index']],
                    ['label' => 'Accion Centralizada', 'icon' => 'fa fa-calendar-o', 'url' => ['/accion-centralizada-variables/index']],
                   
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
                        'icon' => 'fa fa-briefcase', 
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
                        'icon' => 'fa fa-cutlery',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Lista', 'icon' => 'glyphicon glyphicon-th-list', 'url' => ['/materiales-servicios/index']],
                            ['label' => 'Importar', 'icon' => 'glyphicon glyphicon-import', 'url' => ['/materiales-servicios/importar']]
                        ]
                    ],

                    //SISTEMA
                    ['label' => 'Sistema', 'options' => ['class' => 'header']],
                    //Items
                    ['label' => 'Auditoría', 'icon' => 'fa fa-code-fork', 'url' => ['/audit']],
                    ['label' => 'Debug', 'icon' => 'fa fa-bug', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],                    
                ],
            ]
        ) ?>

    </section>

</aside>
