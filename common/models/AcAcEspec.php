<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\AcEspUej;
use backend\models\AccionCentralizadaVariables;
use frontend\models\AccionCentralizadaVariableEjecucion;
/**
 * This is the model class for table "accion_centralizada_accion_especifica".
 *
 * @property integer $id
 * @property integer $id_ac_centr
 * @property string $cod_ac_espe
 * @property string $nombre
 * @property string $estatus
 * @property string $fecha_inicio 
 * @property string $fecha_fin
 *
 * @property AccionCentralizada $idAcCentr
 * @property AcVariable[] $acVariables
 */
class AcAcEspec extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada_accion_especifica';
    }

    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior'
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['id_ac_centr', 'cod_ac_espe', 'nombre', 'estatus', 'fecha_inicio', 'fecha_fin',], 'required'],
            [['id_ac_centr'], 'integer'],
            [['cod_ac_espe'], 'unique'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            //['fecha_inicio', 'compare', 'compareAttribute' => 'fecha_fin', 'operator' => '<'],
            [['id_ac_centr'], 'exist', 'skipOnError' => true, 'targetClass' => AccionCentralizada::className(), 'targetAttribute' => ['id_ac_centr' => 'id']],
            ['fecha_inicio', 'validarFecha'],
            [['cod_ac_espe'], 'string', 'max' => 6]
        ];
    }

    /**
    * Regla Validar Fecha inicio debe ser mayor Fecha fin
    */
    public function validarFecha()
    {   
        $fecha1=date(str_replace("/", "-", $this->fecha_inicio));
        $fecha2=date(str_replace("/", "-", $this->fecha_fin));
        if(strtotime($fecha1)>strtotime($fecha2))
        {
            $this->addError('fecha_inicio','Fecha Inicio no puede ser mayor a Fecha Fin');
            $this->addError('fecha_fin','Fecha Fin no puede ser menor a Fecha Inicio');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ac_centr' => 'Id Accion Centralizada',
            'cod_ac_espe' => 'Cod. Accion Especifica',
            'nombre' => 'Nombre Accion Especifica',
            'estatus' => 'Estatus',
            'nombreEstatus' => 'Estatus'
        ];
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            //Cambiar el formato de las fechas
            $formato = 'd/m/Y';
            $inicio = date_create_from_format($formato,$this->fecha_inicio);
            $fin = date_create_from_format($formato,$this->fecha_fin);

            if($inicio != false)
            {
                $this->fecha_inicio = date_format($inicio,'Y-m-d');
            }
            
            if($fin != false) 
            {
                $this->fecha_fin = date_format($fin,'Y-m-d');
            }
            
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAcCentr()
    {
        return $this->hasOne(AccionCentralizada::className(), ['id' => 'id_ac_centr']);
    }

    public function getIdAccuej()
    {
        return $this->hasmany(AcEspUej::className(), ['id_ac_esp' => 'id']);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcVariables()
    {
        return $this->hasMany(AcVariable::className(), ['id_ac_esp' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionVariables()
    {
        return $this->hasMany(AccioncentralizadaVariables::className(), ['acc_accion_especifica' => 'id']);
    }

    /*
    *Verifica si existen acuej asociadas a la accion
    */
    public function existe_uej()
    {
      $resultado =ArrayHelper::map(AcEspUej::find()->limit(1)->where('id_ac_esp= :id', ['id'=>$this->id])->all(),'id','id_ue');
      if(count($resultado)>0)
      {
        return(1);
      }
      else
      {
        return(0);
      }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
/*    public function getAccionAsignar()
    {
        return $this->hasMany(AccioncentralizadaAsignar::className(), ['accion_especifica_ue' => 'id']);
    }
*/

    /*
    * devuelve nombre de estatus
    */
    public   function getnombreEstatus()
    {
      return ($this->estatus == 1)? 'Activo':'Inactivo';
    }


    public function desactivar()
    {
        $this->estatus = 0;
        $this->save();
    }

     /**
     * Colocar estatus en 1 "Activo"
     */
     public function activar()
     {
        $this->estatus = 1;
        $this->save();
     }

     /**
      * Activar o desactivar
      */
     public function toggleActivo()
     {
        if($this->estatus == 1)
        {
            $this->desactivar();
        }
        else
        {
            $this->activar();
        }

        return true;
     }


     /*
      Permite Agregar/Borrar las UE del combo select2
     */
     function uejecutoras($id_uej)
     {

      /*
      Vaciar Si viene null
      */
      if($id_uej==null){
        $id_uej='';

      }
      /*
      Query para buscar si quitaron una unidad si trae algo hay q borrarlas
      */
      $ace = AcEspUej::find()
              ->select('accion_centralizada_ac_especifica_uej.id')
              ->where(['accion_centralizada_ac_especifica_uej.id_ac_esp' => $this->id])
              ->andwhere(['accion_centralizada_ac_especifica_uej.estatus' => 1])
              ->andwhere(['not in', 'accion_centralizada_ac_especifica_uej.id_ue', $id_uej])
              ->asArray()
              ->all();
        
        /*
        Si encontró algo, son las unidades que deben ser eliminadas
        */
        if($ace!=null)
        {
        
          foreach ($ace as $key => $value) 
          {
            $model_cambiar= AcEspUej::findOne($value);
            //se verifica si existe alguna asociación con asignar de ser asi no se puede eliminar
            if(isset($model_cambiar->idAccionCentralizadaAsignar) && $model_cambiar->idAccionCentralizadaAsignar!=null)
            {
              return false;
            }
            else
            {
              $model_cambiar->delete();
            }
          }
        }
        /*
        Ya se borraron ahora query para buscar si agregaron una unidad nueva,
        si es asi almacenar y guardar
        */
        $ace = AcEspUej::find()
              ->select('accion_centralizada_ac_especifica_uej.id_ue')
              ->where(['accion_centralizada_ac_especifica_uej.id_ac_esp' => $this->id])
              ->andwhere(['accion_centralizada_ac_especifica_uej.estatus' => 1])
              ->andwhere(['in', 'accion_centralizada_ac_especifica_uej.id_ue', $id_uej])
              ->asArray()
              ->all();
        
        
        /*
        Declaro arreglo donde se guardará los nuevos elementos agregados
        */
        $tabla[]=null;
        foreach ($ace as $key => $value) {
          
        $tabla[]=$value['id_ue'];
        
        }

        //si viene null lo declaro arreglo vacio
        if($id_uej==null){
          $id_uej=[];
        }
        /*
        Guardo en $nuevo los elementos nuevos que se han agregado.
        */
        $nuevo=array_diff($id_uej, $tabla);
        
        foreach ($nuevo as $key => $value) {
        $model_uej=new AcEspUej;
        $model_uej->id_ue=$value;
        $model_uej->id_ac_esp=$this->id;  
        $model_uej->save();
        }

        
      }

      /*
      Funcion para guardar las unidades ejecutoras relacionadas con las acc (solamente para la accion create)
      */
      public function uejecutoras_crear($id_ue)
      {
        $model_uej=new AcEspUej;
        $model_uej->id_ue=$id_ue;
        $model_uej->id_ac_esp=$this->id;
        if($model_uej->save())
        {
          return true;
        }
        else
        {
          return false;
        }
      }
  /**
  *
  *Proceso para eliminar todo lo relacionado con la acción especifica de la accion centralizada por el admin.
  */
  public function eliminarTodoEspecifica()
  {
      //buscamos las acciones especificas
      $accionesespecificas=AcAcEspec::find()->where(['id' => $this->id])->all();
      if($accionesespecificas!=null)
      {
        
        foreach ($accionesespecificas as $key => $value2) 
        {
          //buscamos las unidades ejecutoras asociadas a esas acciones
          $uejecutoras=AcEspUej::find()->where(['id_ac_esp' =>$value2->id])->all();

          if($uejecutoras!=null)
          {
              //buscamos los asignaciones de esas unidades ejecutoras(usuarios)
              foreach ($uejecutoras as $key => $value4)
              {
                //almacenamos los asignaciones
                $asignaciones=AccionCentralizadaAsignar::find()->where(['accion_especifica_ue' => $value4->id])->All();
                
                if($asignaciones!=null)
                {
                  foreach ($asignaciones as $key => $value3)
                  {
                    //buscamos los pedidos hechos por esos usuarios-unidad-ejecutora
                    $pedido=AccionCentralizadaPedido::find()->where(['asignado' => $value3->id])->All();
                    
                    if($pedido!=null)
                    {
                      foreach ($pedido as $key => $value)
                      {
                        // se borra el pedido
                        $value->delete();
                      };
                    }
                    //se borra asignacion si no existen pedidos
                    $value3->delete();
                  };
                }
                //se borra unidad-ejecutora
                $value4->delete();
              }//fin del for de buscar asignaciones
          } // fin del if uejecutoras
          //listo primera parte

          //buscamos la eliminacino de las acciones centralizadas variables
          $variables=AccionCentralizadaVariables::find()->where(['acc_accion_especifica' =>$value2->id])->all();
          if($variables!=null)
          {
            //buscamos las variables asociadas al proyecto
            foreach ($variables as $key => $value) 
            {
                //buscamos las localizaciones asociadas a esa variable
                if($value!=null)
                {
                    $localizaciones=$value->localizacionAccVariables;

                    foreach ($localizaciones as $key => $value5)
                    {
                        if($value5!=null)
                        {
                            //buscamos las programaciones y ejecuciones de esas variables
                            $programaciones=AccionCentralizadaVariableProgramacion::find()->where(['id' => $value5->idAccionCentralizadaProgramacion->id])->One();
                            
                              if($programaciones!=null)
                              {
                                $modelojecucion=AccionCentralizadaVariableEjecucion::find()->where(['id_programacion'=> $programaciones->id])->One();
                                if($modelojecucion!=null)
                                {
                                  //borrando la ejecucion
                                  $modelojecucion->delete();
                                }
                                //borrando la programacion
                                $programaciones->delete();  
                              }
                            //borrando localizacion
                            $value5->delete();
                        }
                    }//fin del foreach de localizacion
                    //borrando variables
                    $value->delete();
                }//fin del foreach del variables
            }
          }

          
        }//fin del for de buscar acciones especificas
         //eliminado el acacespecifica
        if(AcAcEspec::findOne($this->id)->delete())
        {
            return true;
        }
        else
        {
            return false;
        }
          
      }//fin de buscar acciones especificas
  }
}
