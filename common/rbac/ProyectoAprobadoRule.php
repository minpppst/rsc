<?php
	
	namespace common\rbac;
	use common\models\Proyecto;
	use common\models\ProyectoLocalizacion;
	use common\models\ProyectoAccionEspecifica;
	use common\models\ProyectoAlcance;
	use yii\rbac\Rule;
	use Yii;

	/**
	 * Checks if authorID matches user passed via params
	 */
	class ProyectoAprobadoRule extends Rule
	{
	    public $name = 'ProyectoAprobado';

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
	     		case ('proyecto/update'==$item->name || 'proyecto/delete'==$item->name) :

	     			
	     			if(Yii::$app->request->get('id')!=NULL)
		    			{

				       		$proyecto=Proyecto::findOne(Yii::$app->request->get('id'));
				     		return $proyecto->aprobado==1 ? false : true;
			     		}
			     		else
			     		{
			     			if($params!=NULL)
			     			{
				     			if(isset($params['proyecto']) && $params['proyecto']!=NULL)
				     			{
				     				$proyecto=Proyecto::findOne($params['proyecto']);
					     			return $proyecto->aprobado==1 ? false : true;	
				     			}
				     			else
				     			{
				     				$proyecto=Proyecto::findOne($params['id']);
					     			return $proyecto->aprobado==1 ? false : true;		
				     			}
				     			
				     		}
				     		else
				     		{
				     			$proyecto=Proyecto::findOne(Yii::$app->request->get('proyecto'));
					     		return $proyecto->aprobado==1 ? false : true;
				     		}
			     			
			     		}

			     break;

			    case ('proyecto-localizacion/update'==$item->name || 'proyecto-localizacion/delete'==$item->name || 'proyecto-localizacion/create'==$item->name) :

		       		$proyecto=ProyectoLocalizacion::findOne(Yii::$app->request->get('id'));
		     		if(isset($proyecto->idProyecto->aprobado))
		     		{
		     			return $proyecto->idProyecto->aprobado==1 ? false : true;	
		     		}
		     		else
		     		{
		     			return true;
		     		}
		     		

	     		break;

	     		case 
	     		('proyecto-responsable/update'==$item->name || 'proyecto-responsable/delete'==$item->name || 'proyecto-responsable/create'==$item->name ||
	     		'proyecto-responsable-administrativo/create'==$item->name || 'proyecto-responsable-administrativo/create-alt'==$item->name || 
	     		'proyecto-responsable-administrativo/delete'==$item->name || 'proyecto-responsable-administrativo/update'==$item->name || 
	     		'proyecto-responsable-tecnico/delete'==$item->name ||
	     		'proyecto-responsable-tecnico/create'==$item->name || 'proyecto-responsable-tecnico/update'==$item->name ||
	     		'proyecto-responsable-administrativo-tecnico/delete'==$item->name || 'proyecto-registrador/create'==$item->name ||
	     		'proyecto-responsable-registrador/delete'==$item->name || 'proyecto-registrador/create'==$item->name || 'proyecto-registrador/update'==$item->name) :
	     		
	     			
		       		$proyecto=Proyecto::findOne(Yii::$app->request->get('id'));
		       		if(isset($proyecto))
		       		{
		     			return $proyecto->aprobado==1 ? false : true;
		     		}
		     		else
		     		{
		     			return true;
		     		}

	     		break; 

	     		case ('proyecto-alcance/update'==$item->name || 'proyecto-alcance/delete'==$item->name || 'proyecto-alcance/create'==$item->name) :
					
					$proyecto=ProyectoAlcance::findOne(Yii::$app->request->get('id'));
					if(isset($proyecto))
					{
						return $proyecto->proyecto->aprobado==1 ? false : true;	
					}
					else
					{
						return true;
					}
		     		

	     		break;

	     		case 
	     		($item->name=='proyecto-accion-especifica/update' || $item->name=='proyecto-accion-especifica/delete' 
	     			|| $item->name=='proyecto-accion-especifica/toggle-activo' 
	     			|| $item->name=='proyecto-accion-especifica/bulk-desactivar' 
	     			|| $item->name=='proyecto-accion-especifica/activar' 
	     			|| $item->name=='proyecto-accion-especifica/create') :

	    			if(Yii::$app->request->get('proyecto')!=NULL)
	    			{
	    				$id=Yii::$app->request->get('proyecto'); 
	    				$proyecto=ProyectoAccionEspecifica::find()->where(['id_proyecto' => $id])->One();
	    			}
	    			else
	    			{ 
	    				$id=Yii::$app->request->get('id');
	    				$proyecto=ProyectoAccionEspecifica::findOne($id);
	    				
	    			}
		       		
		     		if(isset($proyecto))
		     		{
		     			return $proyecto->idProyecto->aprobado==1 ? false: true;	
		     		}
		     		else
		     		{
		     			return true;
		     		}
		     		
	     		
	     		break;

	     	}

	     	}//fin del else

	    }
	}
?>