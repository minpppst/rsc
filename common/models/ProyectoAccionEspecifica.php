<?php

namespace common\models;

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
    public function rules()
    {
        return [
            [['id_proyecto', 'codigo_accion_especifica', 'unidad_medida', 'meta', 'ponderacion', 'bien_servicio', 'id_unidad_ejecutora', 'fecha_inicio', 'fecha_fin', 'estatus'], 'required'],
            [['id_proyecto', 'unidad_medida', 'meta', 'id_unidad_ejecutora', 'estatus', 'aprobado'], 'integer'],
            [['nombre', 'bien_servicio'], 'string'],
            [['ponderacion'], 'number'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['codigo_accion_especifica'], 'string', 'max' => 3],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['id_proyecto' => 'id']],
            [['id_unidad_ejecutora'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadEjecutora::className(), 'targetAttribute' => ['id_unidad_ejecutora' => 'id']],
        ];
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
            'bien_servicio' => 'Bien o Servicio',
            'id_unidad_ejecutora' => 'Unidad Ejecutora',
            'nombreUnidadEjecutora' => 'Unidad Ejecutora',
            'estatus' => 'Estatus',
            'nombreEstatus' => 'Estatus',
            'nombreProyecto' => 'Proyecto',
            'nombreUnidadMedida' => 'Unidad de Medida',
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
      * @return int $sum suma total de las ponderaciones
      */
     public function ponderacion()
     {
        $comando = \Yii::$app->db->createCommand('SELECT SUM(ponderacion) FROM proyecto_accion_especifica WHERE id_proyecto = '.$this->id_proyecto);
        $sum = $comando->queryScalar();

        return $sum;
     }
}
