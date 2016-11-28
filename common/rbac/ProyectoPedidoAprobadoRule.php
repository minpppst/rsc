<?php
	
	namespace common\rbac;
	use common\models\ProyectoAccionEspecifica;
	use common\models\ProyectoPedido;
	use common\models\ProyectoUsuarioAsignar;
	use yii\rbac\Rule;
	use Yii;

	/**
	 * Checks if authorID matches user passed via params
	 */
	class ProyectoPedidoAprobadoRule extends Rule
	{
	    public $name = 'ProyectoPedidoAprobado';

	    /**
	     * @param string|integer $user the user ID.
	     * @param Item $item the role or permission that this rule is associated with
	     * @param array $params parameters passed to ManagerInterface::checkAccess().
	     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
	     */
	    public function execute($user, $item, $params)
	    {
	    
	       
	    //admin no deberia ser afectado por la regla
	    
	    	if(Yii::$app->user->can('sysadmin'))
	    	{
	    		return true;
	    	}
	    	else
	    	{
	    		
	     	switch(true)
	     	{
	     		case ('proyecto-pedido/update'==$item->name || 'proyecto-pedido/delete'==$item->name || 'proyecto-pedido/create'==$item->name) :

	     			if(Yii::$app->request->get('id')!=NULL)
		    		{

				       	$proyecto=ProyectoPedido::findOne(Yii::$app->request->get('id'));
				     	if($proyecto!=NULL)
				     	{
				     		return $proyecto->asignado0->proyectoEspecifica->aprobado==1 ? false : true;	
				     	}
				     	
			     	}
			     	else
			     	{
				     	if(Yii::$app->request->get('asignar')!=NULL)
			    		{

					       	$proyecto=ProyectoUsuarioAsignar::findOne(Yii::$app->request->get('asignar'));
					       	
					     	return $proyecto->proyectoEspecifica->aprobado==1 ? false : true;
				     	}
			     	}

			     break;

			    
	     	}

	     	}//fin del else

	    }
	}
?>