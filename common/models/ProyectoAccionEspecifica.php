<?php

namespace common\models;
use backend\models\ProyectoVariables;
use Yii;

/**
 * This is the model class for table "proyecto_accion_especifica".
 *
 * @property integer $id
 * @property integer $id_proyecto
 * @property string $codigo_accion_especifica
 * @property string $nombre
 * @property integer $unidad_medida 
 * @property integer $meta 
 * @property double $ponderacion 
 * @property string $bien_servicio
 * @property integer $id_unidad_ejecutora
 * @property integer $ambito
 * @property string $fecha_inicio 
 * @property string $fecha_fin
 * @property integer $estatus
 *
 * @property ProgramacionFisicaPresupuestaria[] $programacionFisicaPresupuestarias
 * @property Proyecto $idProyecto
 * @property UnidadEjecutora $idUnidadEjecutora
 * @property ProyectoDistribucionPresupuestaria[] $proyectoDistribucionPresupuestarias
 * @property ProyectoEspecificaUe[] $proyectoEspecificaUes 
 */
class ProyectoAccionEspecifica extends \yii\db\ActiveRecord
{
    const EVENT_PEDIDOAPROBADO = 'AprobacionPedido';
    const EVENT_PEDIDODESAPROBADO = 'DesaprobacionPedido';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_accion_especifica';
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
    public function init()
    {
        $this->on(self::EVENT_PEDIDOAPROBADO, [$this, 'notificacionAprobacion']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto', 'codigo_accion_especifica', 'unidad_medida', 'ponderacion', 'bien_servicio', 'id_unidad_ejecutora', 'fecha_inicio', 'fecha_fin', 'estatus', 'ambito'], 'required'],
            [['id_proyecto', 'unidad_medida', 'id_unidad_ejecutora', 'estatus', 'aprobado'], 'integer'],
            [['nombre', 'bien_servicio'], 'string'],
            [['ponderacion'], 'number'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['codigo_accion_especifica'], 'string', 'max' => 8],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['id_proyecto' => 'id']],
            [['id_unidad_ejecutora'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadEjecutora::className(), 'targetAttribute' => ['id_unidad_ejecutora' => 'id']],
            [['ponderacion'], 'match', 'pattern' => '/^(0(?:\.[01-9]){1,2}?|0?\.[01-99]{1,2})$/', 'message' => 'Debe colocar un número entre 0.01 y 0.99'],
            ['fecha_inicio', 'validarFecha'],
        ];
    }

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
     * Notificacion Aprobacion
     */
     public function notificacionAprobacion($evento)
     {
        if($this->aprobado==1)
        {
            //Ids de los usuarios con el rol "proyecto_pedido"
            $usuarios = \Yii::$app->authManager->getUserIdsByRole('proyecto_pedido');
            $usuarios=ProyectoUsuarioAsignar::find()
            ->where(['proyecto_usuario_asignar.accion_especifica_id' => $this->id])
            ->andWhere(['proyecto_usuario_asignar.usuario_id' => $usuarios])
            ->all();
            $bandera=0;
            foreach ($usuarios as $key => $value) 
            {
                //verificar si quien aprueba/desaprueba esta asociado al proyecto
                if($value['usuario_id']==\Yii::$app->user->id)
                {
                    $bandera=1;
                }
                // usuarios pertenecientes a esa unidad ejecutora
                Notification::notify(Notification::KEY_PEDIDOAPROBADO, $value['usuario_id'], $this->id); 
            }
            
            if($bandera==0)
            {
                //enviar a quien lo hace, pues no necesariamente este asociada al proyecto
                Notificaciones::notify(Notificaciones::KEY_ACPEDIDOAPROBADO, \Yii::$app->user->id, $this->id);
            }
            /**
            /*NOTA
            /*puede darse el caso que existan usuarios del backend que no este asociados, pero igual por su rol 
            /*deben llegarle las notificaciones, una vez definidos estos roles se les debe enviar las notificaciones.
            */
        }
        else
        {
            $usuarios = \Yii::$app->authManager->getUserIdsByRole('proyecto_pedido');
            $usuarios=ProyectoUsuarioAsignar::find()
            ->where(['proyecto_usuario_asignar.accion_especifica_id' => $this->id])
            ->andWhere(['proyecto_usuario_asignar.usuario_id' => $usuarios])
            ->all();
            $bandera=0;
            foreach ($usuarios as $key => $value) 
            {
                //verificar si quien aprueba/desaprueba esta asociado al proyecto
                if($value['usuario_id']==\Yii::$app->user->id)
                {
                    $bandera=1;
                }
                // usuarios pertenecientes a esa unidad ejecutora
                Notification::notify(Notification::KEY_PEDIDODESAPROBADO, $value['usuario_id'], $this->id); 
            }
            
            if($bandera==0)
            {
                //enviar a quien lo hace, pues no necesariamente este asociada al proyecto
                Notificaciones::notify(Notificaciones::KEY_ACPEDIDOAPROBADO, \Yii::$app->user->id, $this->id);
            }
            /**
            /*NOTA
            /*puede darse el caso que existan usuarios del backend que no este asociados, pero igual por su rol 
            /*deben llegarle las notificaciones, una vez definidos estos roles se les debe enviar las notificaciones.
            */
        }

     }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_proyecto' => 'Id Proyecto',
            'codigo_accion_especifica' => 'Codigo Accion Especifica',
            'nombre' => 'Nombre',
            'unidad_medida' => 'Unidad de Medida',
            'meta' => 'Meta',
            'ponderacion' => 'Ponderación',
            'bien_servicio' => 'Descripción del Bien o Servicio',
            'id_unidad_ejecutora' => 'Unidad Ejecutora',
            'nombreUnidadEjecutora' => 'Unidad Ejecutora',
            'estatus' => 'Estatus',
            'nombreEstatus' => 'Estatus',
            'nombreProyecto' => 'Proyecto',
            'nombreUnidadMedida' => 'Unidad de Medida',
            'ambito' => 'Ambito',
            'aprobado' => 'Aprobado'
        ];
    }

    
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramacionFisicaPresupuestarias()
    {
        return $this->hasMany(ProgramacionFisicaPresupuestaria::className(), ['id_proyecto_accion_especifica' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['id' => 'id_proyecto']);
    }


    /**
     * @return string
     */
    public function getNombreProyecto()
    {
        if($this->idProyecto == null)
        {
            return null;
        }

        return $this->idProyecto->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUnidadMedida()
    {
        return $this->hasOne(UnidadMedida::className(), ['id' => 'unidad_medida']);
    }

    /**
     * @return string
     */
    public function getNombreUnidadMedida()
    {
        if($this->idUnidadMedida == null)
        {
            return null;
        }

        return $this->idUnidadMedida->unidad_medida;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUnidadEjecutora()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'id_unidad_ejecutora']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacion()
    {
        return $this->hasOne(ProyectoUsuarioAsignar::className(), ['accion_especifica_id' => 'id' ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariable()
    {
        return $this->hasOne(ProyectoVariables::className(), ['accion_especifica' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAmbito()
    {
        return $this->hasOne(Ambito::className(), ['id' => 'ambito']);
    }

    /**
     * Devuelve la relacion entre proyecto_accion_especifica y
     * proyecto_ae_meta.
     * @return \yii\db\ActiveQuery
     */
    public function getAeMeta()
    {
        return $this->hasOne(ProyectoAeMeta::className(), ['id_proyecto_accion_especifica' => 'id']);
    }

    /**
     * Obtener la meta física.
     * @return int Meta de la acción específica
     */
    public function getMeta()
    {
        //Calcular la meta
        $meta = Yii::$app->db->createCommand("
            SELECT SUM(
                a.enero +
                a.febrero +
                a.marzo +
                a.abril +
                a.mayo +
                a.junio +
                a.julio +
                a.agosto +
                a.septiembre +
                a.octubre +
                a.noviembre +
                a.diciembre
            ) AS 'total'
            FROM
                proyecto_ae_meta as a, proyecto_ac_localizacion as b
            WHERE
                id_proyecto_ac_localizacion =b.id and
                b.id_proyecto_ac = :accion_especifica", 
            [':accion_especifica' => $this->id])
        ->queryScalar();

        return $meta;
    }

    /**
     * @return string
     */
    public function getNombreUnidadEjecutora()
    {
        if($this->idUnidadEjecutora == null)
        {
            return null;
        }

        return $this->idUnidadEjecutora->nombre;
    }


   /**
    * @return string
    */
   public function getNombreEstatus()
    {
        if($this->estatus == 1)
        {
            return "Activo";
        }

        return "Inactivo";
    }

   /**
     * Colocar estatus en 0 "Inactivo"
     */
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
      * @return boolean
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

     /**
      * Ponderacion.
      * @return int $sum Suma total de las ponderaciones
      */
    public function ponderacion()
    {
        //no puedo tomarse en cuenta el mismo en la suma (update)
        if($this->id==null)
        {
            $filtro='';
        }
        else
        {
            $filtro=' and id<>'.$this->id;
        }
        $comando = \Yii::$app->db->createCommand('SELECT SUM(ponderacion) FROM proyecto_accion_especifica WHERE id_proyecto = '.$this->id_proyecto. ' ' .$filtro);
        $sum = $comando->queryScalar();

        return $sum;
    }

     /**
      * Devuelve el máximo de ponderación.
      * @return int
      */
    public function getMaxPonderacion()
    {
        
        if($this->ponderacion() == 0)
        {
            return 0.99;
        }
        return (1.00 - $this->ponderacion());
    }

     /**
      * Devuelve el minimo de ponderacion.
      * @return int 
      */
    public function getMinPonderacion()
    {
        if($this->ponderacion() == 1.00)
        {
            return 0;
        }

        return 0.01;
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

    /*
    * Eliminar la accion especifica y todo lo relacionada con ella (admin)
    *
    */
    public function EliminarAccionTodo()
    {
        //traemos la accion especificas
        $value=ProyectoAccionEspecifica::findOne($this->id);
        $asignaciones=ProyectoUsuarioAsignar::find()->where(['accion_especifica_id' =>$value->id])->all();

        
        if($asignaciones!=null)
        {
            
            //buscamos los pedidos de esas asignaciones
            foreach ($asignaciones as $key => $value1)
            {
                $pedidos=$value1->proyectoPedidos;

                if($pedidos!=null)
                {
                    foreach ($pedidos as $key => $value2)
                    {
                        // se borra el pedido
                        $value2->delete();
                    }
                }
                //se borra la asignacion una vez que se borre los pedidos
                
                $value1->delete();
            }//fin del while de buscar pedido
        } // fin del if de asignaciones

        //buscamos los proyectos variables
        $variables=ProyectoVariables::find()->where(['accion_especifica' =>$value->id])->all();
        if($variables!=null)
        {
            //buscamos las variables asociadas al proyecto
            foreach ($variables as $key => $value3) 
            {
                //buscamos las localizaciones asociadas a esa variable
                if($value3!=null)
                {
                    $localizaciones=$value3->proyectoVariableLocalizacions;

                    foreach ($localizaciones as $key => $value4) 
                    {
                        if($value4!=null)
                        {
                            //buscamos las programaciones y ejecuciones de esas variables
                            foreach ($value4->proyectoVariableProgramacions as $key => $value5) 
                            {
                                $modelojecucion=ProyectoVariableEjecucion::find()->where(['id_programacion'=> $value5->id])->One();
                                if($modelojecucion!=null)
                                {
                                    //borrando la ejecucion
                                    $modelojecucion->delete();
                                }
                                //borrando la programacion
                                $value5->delete();
                            }

                            $value4->delete();
                        }
                    }//fin del foreach de localizacion
                    //borrando variables
                    $value3->delete();
                }//fin del foreach del variables
            }
        }
        //eliminamos la accion
        if(ProyectoAccionEspecifica::findOne($this->id)->delete())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
