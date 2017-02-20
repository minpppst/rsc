<?php
	/**
	 * items.php
	 * Items del menu.
	 */
	//Instanciar el usuario
	$usuario = \Yii::$app->user;
	
	//Inicializar el arreglo
	$items = [];

	//CONTROL DE ACCESO	
	if($usuario->getIdentity()->administrator == 1)
	{
		//Header
		$items[] =	['label' => 'Control de Acceso', 'options' => ['class' => 'header']];
		//Items
		$items[] =	['label' => 'Usuarios', 'icon' => 'fa fa-user', 'url' => ['/manager/index']];
		$items[] =	['label' => 'Roles', 'icon' => 'fa fa-asterisk', 'url' => ['/role/index']];
		$items[] =	['label' => 'Permisos', 'icon' => 'fa fa-key', 'url' => ['/rbac/permission']];
		$items[] =	['label' => 'Reglas', 'icon' => 'fa fa-eye', 'url' => ['/rbac/rule']];
	}

	//PROYECTO Y ACC
	if($usuario->can('sysadmin') || $usuario->can('Planificacion')){
		//Header
		$items[] =	['label' => 'Proyectos y Acciones Centralizadas', 'options' => ['class' => 'header']];
		//Items
		$items[] =	['label' => 'Proyecto', 'icon' => 'fa fa-folder', 'url' => ['/proyecto/index']];
		$items[] =	['label' => 'Acción Centralizada', 'icon' => 'fa fa-folder-open', 'url' => ['/accion-centralizada/index']]; 
	}


	//ASIGNACIONES
	if($usuario->can('sysadmin') || $usuario->can('Planificacion') || $usuario->can('Presupuesto'))
	{
		//Header
		$items[] =	['label' => 'Asginar Usuarios', 'options' => ['class' => 'header']];
		//Items
		$items[] =	['label' => 'Asignar a proyecto', 'icon' => 'fa fa-folder-o', 'url' => ['/proyecto-usuario-asignar/index']];
		$items[] =	['label' => 'Asignar a acción centralizada', 'icon' => 'fa fa-folder-open-o', 'url' => ['/accion-centralizada-asignar/index']];
	}

	//PEDIDOS
	if($usuario->can('sysadmin') || $usuario->can('Presupuesto'))
	{
		//Header
		$items[] =	['label' => 'Requerimientos/Solicitudes', 'options' => ['class' => 'header']];
		//Items                    
		$items[] =	['label' => 'Proyecto requerimiento', 'icon' => 'fa fa-shopping-cart ', 'url' => ['/proyecto-pedido/index']];
		$items[] =	['label' => 'ACC requerimiento', 'icon' => 'fa fa-shopping-basket ', 'url' => ['/accion-centralizada-pedido/index']];
	}

	//VARIABLES
	if($usuario->can('sysadmin') || $usuario->can('Planificacion'))
	{
		//header
		$items[] =	['label' => 'Variables', 'options' => ['class' => 'header']];
		//Items
		$items[] =	['label' => 'Proyecto', 'icon' => 'fa fa-calendar-check-o', 'url' => ['/proyecto-variables/index']];
		$items[] =	['label' => 'Accion Centralizada', 'icon' => 'fa fa-calendar-o', 'url' => ['/accion-centralizada-variables/index']];
	}

	//PROPIEDADES
	if($usuario->can('sysadmin')){
		//Header
		$items[] =	['label' => 'Propiedades', 'options' => ['class' => 'header']];
		$items[] =	[
		   		'label' => 'Reportes Presupuesto', 
		   		'icon' => 'glyphicon glyphicon-folder-open', 
		   		'url' => '#',
		   		'items' => [
		       		['label' => 'Reporte 1', 'icon' => 'glyphicon glyphicon-list-alt', 'url' => ['/reportes-presupuesto/reporte1'],],
		   		]
			];
		$items[] =	[
		   'label' => 'Partidas', 
		   'icon' => 'glyphicon glyphicon-list-alt', 
		   'url' => '#',
		   'items' => [
		       ['label' => 'Partida', 'icon' => 'glyphicon glyphicon-list-alt', 'url' => ['/partida-partida/index'],],
		       ['label' => 'Genérica', 'icon' => 'glyphicon glyphicon-tree-deciduous', 'url' => ['/partida-generica/index'],],
		       ['label' => 'Específica', 'icon' => 'glyphicon glyphicon-tree-conifer', 'url' => ['/partida-especifica/index'],],
		       ['label' => 'Sub-específica', 'icon' => 'glyphicon glyphicon-leaf', 'url' => ['/partida-sub-especifica/index'],],
		   ]

		];

		$items[] =	['label' => 'Partidas - Unidades Ejecutoras', 'icon' => 'glyphicon glyphicon-list-alt', 'url' => ['/ue-partida-entidad/index']];
		$items[] =	[
		   'label' => 'Objetivos',
		   'icon' => 'glyphicon glyphicon-screenshot',
		   'url' => '#',
		   'items' => [
		       ['label' => 'Históricos', 'icon' => 'glyphicon glyphicon-time', 'url' => ['/objetivos-historicos/index'],],
		       ['label' => 'Nacionales', 'icon' => 'glyphicon glyphicon-map-marker', 'url' => ['/objetivos-nacionales/index'],],
		       ['label' => 'Estratégicos', 'icon' => 'glyphicon glyphicon-knight', 'url' => ['/objetivos-estrategicos/index'],],
		       ['label' => 'Generales', 'icon' => 'glyphicon glyphicon-star', 'url' => ['/objetivos-generales/index'],],
		   ]
		];

		$items[] =	[
		   'label' => 'Unidades Ejecutoras', 
		   'icon' => 'fa fa-briefcase', 
		   'url' => '#',
		   'items' => [
		       ['label' => 'Lista', 'icon' => 'glyphicon glyphicon-th-list', 'url' => ['/unidad-ejecutora/index'],],
		       ['label' => 'Importar', 'icon' => 'glyphicon glyphicon-import', 'url' => ['/unidad-ejecutora/importar'],],                                    
		   ]
		];

		$items[] =	['label' => 'Unidades de Medida', 'icon' => 'glyphicon glyphicon-scale', 'url' => ['/unidad-medida/index']];
		$items[] =	['label' => 'Presentaciones', 'icon' => 'glyphicon glyphicon-blackboard', 'url' => ['/presentacion/index']];
		$items[] =	[
		   'label' => 'Materiales y Servicios', 
		   'icon' => 'fa fa-cutlery',
		   'url' => '#',
		   'items' => [
		    	['label' => 'Lista', 'icon' => 'glyphicon glyphicon-th-list', 'url' => ['/materiales-servicios/index']],
		       	['label' => 'Importar', 'icon' => 'glyphicon glyphicon-import', 'url' => ['/materiales-servicios/importar']],
		       	['label' => 'Cambio Precio', 'icon' => 'glyphicon glyphicon-retweet', 'url' => ['/materiales-servicios/buscarmaterial']],
		   ]
		];
		
		$items[] =	[
		   'label' => 'Propiedades Proyecto', 
		   'icon' => 'fa fa-folder',
		   'url' => '#',
		   'items' => [
		       ['label' => 'Situación Presupuestaria', 'icon' => 'glyphicon glyphicon-th-list', 'url' => ['/situacion-presupuestaria/index'],],
		       ['label' => 'Estatus Proyecto', 'icon' => 'glyphicon glyphicon-th-list', 'url' => ['/estatus-proyecto/index'],],
		       ['label' => 'Plan Operativo', 'icon' => 'glyphicon glyphicon-th-list', 'url' => ['/plan-operativo/index'],],
		       ['label' => 'Sector Proyecto', 'icon' => 'glyphicon glyphicon-th-list', 'url' => ['/sector/index'],],
		       ['label' => 'Sub-Sector Proyecto', 'icon' => 'glyphicon glyphicon-th-list', 'url' => ['/sub-sector/index'],],
		   ]
		];
	}

	//Presupuesto, Materiales, ue y partidas
	if($usuario->can('Presupuesto'))
	{
		//Header
		$items[] =	['label' => 'Materiales', 'options' => ['class' => 'header']];
		$items[] =	[
			   'label' => 'Materiales y Servicios', 
			   'icon' => 'fa fa-cutlery',
			   'url' => '#',
			   'items' => [
			    	['label' => 'Lista', 'icon' => 'glyphicon glyphicon-th-list', 'url' => ['/materiales-servicios/index']],
			       	['label' => 'Importar', 'icon' => 'glyphicon glyphicon-import', 'url' => ['/materiales-servicios/importar']],
			       	['label' => 'Cambio Precio', 'icon' => 'glyphicon glyphicon-retweet', 'url' => ['/materiales-servicios/buscarmaterial']],
			   ]
			];
		//ue
		$items[] =	['label' => 'Unidades Ejecutoras', 'options' => ['class' => 'header']];
		$items[] =	[
		   		'label' => 'Unidades Ejecutoras', 
		   		'icon' => 'fa fa-briefcase', 
		   		'url' => '#',
		   		'items' => [
		       		['label' => 'Lista', 'icon' => 'glyphicon glyphicon-th-list', 'url' => ['/unidad-ejecutora/index'],],
		       	['label' => 'Importar', 'icon' => 'glyphicon glyphicon-import', 'url' => ['/unidad-ejecutora/importar'],],                                    
		   		]
			];
			//partias
		$items[] =	['label' => 'Partidas', 'options' => ['class' => 'header']];
		$items[] =	[
			   'label' => 'Partidas', 
			   'icon' => 'glyphicon glyphicon-list-alt', 
			   'url' => '#',
			   'items' => [
			       ['label' => 'Partida', 'icon' => 'glyphicon glyphicon-list-alt', 'url' => ['/partida-partida/index'],],
			       ['label' => 'Genérica', 'icon' => 'glyphicon glyphicon-tree-deciduous', 'url' => ['/partida-generica/index'],],
			       ['label' => 'Específica', 'icon' => 'glyphicon glyphicon-tree-conifer', 'url' => ['/partida-especifica/index'],],
			       ['label' => 'Sub-específica', 'icon' => 'glyphicon glyphicon-leaf', 'url' => ['/partida-sub-especifica/index'],],
			   	]

			];

		$items[] =	['label' => 'Partidas - Unidades Ejecutoras', 'icon' => 'glyphicon glyphicon-list-alt', 'url' => ['/ue-partida-entidad/index']];
		//Reportes de presupuesto
		$items[] =	['label' => 'Reportes Presupuesto', 'options' => ['class' => 'header']];
		$items[] =	[
		   		'label' => 'Reportes', 
		   		'icon' => 'glyphicon glyphicon-list-alt', 
		   		'url' => '#',
		   		'items' => [
		       		['label' => 'Reporte 1', 'icon' => 'glyphicon glyphicon-folder-open', 'url' => ['/reportes-presupuesto/reporte1'],],
		   		]
			];
		
	}


	//SISTEMA
	if($usuario->can('sysadmin'))
	{
		//Header
		$items[] =	['label' => 'Sistema', 'options' => ['class' => 'header']];
		//Items
		$items[] =	['label' => 'Auditoría', 'icon' => 'fa fa-code-fork', 'url' => ['/audit']];
		$items[] =	['label' => 'Debug', 'icon' => 'fa fa-bug', 'url' => ['/debug']];
		$items[] =	['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest];
	}


	return $items;