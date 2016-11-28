<?php

namespace backend\models;

use Yii;
use yii\base\Model;

use common\models\Proyecto;
use common\models\UnidadEjecutora;
use common\models\PartidaPartida;
use common\models\ProyectoUsuarioAsignar;
use common\components\Notification;

/**
 * This is the model class for table "proyecto_accion_especifica".
 *
 * @property integer $id
 * @property integer $id_proyecto
 * @property string $codigo_accion_especifica
 * @property string $nombre
 * @property integer $id_unidad_ejecutora
 * @property string $fecha_inicio 
 * @property string $fecha_fin
 * @property integer $estatus
 *
 * @property ProgramacionFisicaPresupuestaria[] $programacionFisicaPresupuestarias
 * @property Proyecto $idProyecto
 * @property UnidadEjecutora $idUnidadEjecutora
 * @property ProyectoAsignar[] $proyectoAsignars
 * @property ProyectoPedido[] $proyectoPedidos 
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto', 'codigo_accion_especifica', 'id_unidad_ejecutora', 'fecha_inicio', 'fecha_fin', 'estatus'], 'required'],
            [['id_proyecto', 'id_unidad_ejecutora', 'estatus'], 'integer'],
            [['nombre'], 'string'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['codigo_accion_especifica'], 'string', 'max' => 3],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['id_proyecto' => 'id']],
            [['id_unidad_ejecutora'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadEjecutora::className(), 'targetAttribute' => ['id_unidad_ejecutora' => 'id']],
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_proyecto' => 'Id Proyecto',
            'codigo_accion_especifica' => 'Codigo Accion Especifica',
            'nombre' => 'Nombre',
            'id_unidad_ejecutora' => 'Unidad Ejecutora',
            'nombreUnidadEjecutora' => 'Unidad Ejecutora',
            'estatus' => 'Estatus',
            'nombreEstatus' => 'Estatus',
            'nombreProyecto' => 'Proyecto'
        ];
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
            foreach ($usuarios as $key => $value) 
            {
                // usuarios pertenecientes a esa unidad ejecutora
                Notification::notify(Notification::KEY_PEDIDOAPROBADO, $value['usuario_id'], $this->id); 
            }
        }
        else
        {
            $usuarios = \Yii::$app->authManager->getUserIdsByRole('proyecto_pedido');
            $usuarios=ProyectoUsuarioAsignar::find()
            ->where(['proyecto_usuario_asignar.accion_especifica_id' => $this->id])
            ->andWhere(['proyecto_usuario_asignar.usuario_id' => $usuarios])
            ->all();
            foreach ($usuarios as $key => $value) 
            {
                // usuarios pertenecientes a esa unidad ejecutora
                Notification::notify(Notification::KEY_PEDIDODESAPROBADO, $value['usuario_id'], $this->id); 
            }   
        }

     }

    /**
     * Guardar en la tabla proyecto_distribucion_presupuestaria
     * @return \yii\db\ActiveQuery
     */
    public function afterSave($insert,$changedAttributes) 
    {
        $partidas = PartidaPartida::find()->all();

        if (!$insert) {
            //nada
        }
        else{
            foreach($partidas as $key => $value)
            {
                $distribucion = new ProyectoDistribucionPresupuestaria();
                $distribucion->id_accion_especifica = $this->id;
                $distribucion->id_partida = $value->id;
                $distribucion->cantidad = 0;
                $distribucion->save(false);
            }
        }

        return parent::afterSave($insert,$changedAttributes);
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
    public function getCodigoProyecto()
    {
        if($this->idProyecto == null)
        {
            return null;
        }

        return $this->idProyecto->codigo_proyecto;
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
    public function getIdUnidadEjecutora()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'id_unidad_ejecutora']);
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
      * Aprobar o desaprobar todos los pedidos
      * de una UE
      * @return boolean
      */
     public function toggleAprobado()
     {
        if($this->aprobado == 1)
        {
            $this->aprobado = 0;
        }
        else
        {
            $this->aprobado = 1;
        }

        $this->save();

        return true;
     }
}
