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
            [['id_proyecto', 'codigo_accion_especifica', 'unidad_medida', 'ponderacion', 'bien_servicio', 'id_unidad_ejecutora', 'fecha_inicio', 'fecha_fin', 'estatus'], 'required'],
            [['id_proyecto', 'unidad_medida', 'id_unidad_ejecutora', 'estatus', 'aprobado'], 'integer'],
            [['nombre', 'bien_servicio'], 'string'],
            [['ponderacion'], 'number'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['codigo_accion_especifica'], 'string', 'max' => 3],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['id_proyecto' => 'id']],
            [['id_unidad_ejecutora'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadEjecutora::className(), 'targetAttribute' => ['id_unidad_ejecutora' => 'id']],
            [['ponderacion'], 'match', 'pattern' => '/^(?:1(?:\.0)?|0(?:\.[1-9])?|0?\.[1-9])$/', 'message' => 'Debe colocar un número entre 0.1 y 0.9'],
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
                enero +
                febrero +
                marzo +
                abril +
                mayo +
                junio +
                julio +
                agosto +
                septiembre +
                octubre +
                noviembre +
                diciembre
            ) AS 'total'
            FROM
                proyecto_ae_meta
            WHERE
                id_proyecto_accion_especifica = :accion_especifica", 
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
      * @return int $sum suma total de las ponderaciones
      */
     public function ponderacion()
     {
        $comando = \Yii::$app->db->createCommand('SELECT SUM(ponderacion) FROM proyecto_accion_especifica WHERE id_proyecto = '.$this->id_proyecto);
        $sum = $comando->queryScalar();

        return $sum;
     }

     /**
      * Override afterSave.
      * @param boolean $insert Verificar si se inserta o actualiza.
      * @param array $changedAttributes Atributos que se van a guardar.
      * @return afterSave().
      */
     public function afterSave($insert, $changedAttributes)
     {       
         if(!$insert)
         {
            //nada
         }
         else
         {
            //crear modelo relacionado
            $meta = new ProyectoAeMeta();

            //Llave foranea
            $meta->id_proyecto_accion_especifica = $this->id;

            //Colocar meses en cero
            $meta->enero = 0;
            $meta->febrero = 0;
            $meta->marzo = 0;
            $meta->abril = 0;
            $meta->mayo = 0;
            $meta->junio = 0;
            $meta->julio = 0;
            $meta->agosto = 0;
            $meta->septiembre = 0;
            $meta->octubre = 0;
            $meta->noviembre = 0;
            $meta->diciembre = 0;
            $meta->estatus = 1; //activo
            $meta->fecha_creacion = date('Y-m-d H:i:s');
            $meta->save(false);
         }
        
        return parent::afterSave($insert, $changedAttributes);
     }
     
}
