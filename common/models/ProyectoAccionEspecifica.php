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
            [['id_proyecto', 'codigo_accion_especifica', 'unidad_medida', 'ponderacion', 'bien_servicio', 'id_unidad_ejecutora', 'fecha_inicio', 'fecha_fin', 'estatus', 'ambito'], 'required'],
            [['id_proyecto', 'unidad_medida', 'id_unidad_ejecutora', 'estatus', 'aprobado'], 'integer'],
            [['nombre', 'bien_servicio'], 'string'],
            [['ponderacion'], 'number'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['codigo_accion_especifica'], 'string', 'max' => 3],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['id_proyecto' => 'id']],
            [['id_unidad_ejecutora'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadEjecutora::className(), 'targetAttribute' => ['id_unidad_ejecutora' => 'id']],
            [['ponderacion'], 'match', 'pattern' => '/^(?:1(?:\.0)?|0(?:\.[1-9])?|0?\.[1-9])$/', 'message' => 'Debe colocar un número entre 0.1 y 0.9'],
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
        $comando = \Yii::$app->db->createCommand('SELECT SUM(ponderacion) FROM proyecto_accion_especifica WHERE id_proyecto = '.$this->id_proyecto);
        $sum = $comando->queryScalar();

        return $sum;
     }

     /**
      * Devuelve el máximo de ponderación.
      * @return int
      */
     public function getMaxPonderacion()
     {
        return (1 - $this->ponderacion());
     }

     /**
      * Devuelve el minimo de ponderacion.
      * @return int 
      */
     public function getMinPonderacion()
     {
        if($this->ponderacion() == 1.0)
        {
            return 0;
        }

        return 0.1;
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

}
