<?php

namespace app\models;

use Yii;
use machour\yii2\notifications\models\Notification;

/**
 * This is the model class for table "proyecto_pedido".
 *
 * @property integer $id
 * @property integer $id_material
 * @property integer $enero
 * @property integer $febrero
 * @property integer $marzo
 * @property integer $abril
 * @property integer $mayo
 * @property integer $junio
 * @property integer $julio
 * @property integer $agosto
 * @property integer $septiembre
 * @property integer $octubre
 * @property integer $noviembre
 * @property integer $diciembre
 * @property string $precio
 * @property string $fecha_creacion
 * @property integer $asignado
 * @property integer $estatus
 *
 * @property ProyectoAsignar $asignado0
 * @property MaterialesServicios $idMaterial
 */
class ProyectoPedido extends \yii\db\ActiveRecord
{

    /**
     * Constante que guarda el nombre del evento
     */
    const EVENT_NUEVO_PEDIDO = 'evento_nuevo_pedido';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->on(self::EVENT_NUEVO_PEDIDO, [$this, 'notificacion']);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_pedido';
    }
    /*
    *Guargar los cambios hechos(auditoria)
    */
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
            [['id_material', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'precio', 'asignado', 'estatus'], 'required'],
            [['id_material', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'asignado', 'estatus'], 'integer'],
            [['precio'], 'number'],
            [['fecha_creacion'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_material' => 'Material',
            'nombreMaterial' => 'Material/Servicio',
            'trimestre1' => 'Trimestre I',
            'trimestre2' => 'Trimestre II',
            'trimestre3' => 'Trimestre III',
            'trimestre4' => 'Trimestre IV',
            'enero' => 'Enero',
            'febrero' => 'Febrero',
            'marzo' => 'Marzo',
            'abril' => 'Abril',
            'mayo' => 'Mayo',
            'junio' => 'Junio',
            'julio' => 'Julio',
            'agosto' => 'Agosto',
            'septiembre' => 'Septiembre',
            'octubre' => 'Octubre',
            'noviembre' => 'Noviembre',
            'diciembre' => 'Diciembre',
            'precio' => 'Precio',
            'fecha_creacion' => 'Fecha Creacion',
            'asignado' => 'ID de la asignacion (Usuario-UE-AC)',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Notificacion
     */
     public function notificacion($evento)
     {
        Notification::notify(Notification::KEY_NUEVO_PEDIDO, 1, $this->id);
     }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignado0()
    {
        return $this->hasOne(ProyectoAsignar::className(), ['id' => 'asignado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMaterial()
    {
        return $this->hasOne(MaterialesServicios::className(), ['id' => 'id_material']);
    }

    /**
     * @return string
     */
    public function getNombreMaterial()
    {
        if($this->idMaterial == null)
        {
            return null;
        }

        return $this->idMaterial->nombre;
    }

    /**
     * @return string
     */
    public function getTrimestre1()
    {
        return ($this->enero+$this->febrero+$this->marzo);
    }

    /**
     * @return string
     */
    public function getTrimestre2()
    {
        return ($this->abril+$this->mayo+$this->junio);
    }

    /**
     * @return string
     */
    public function getTrimestre3()
    {
        return ($this->julio+$this->agosto+$this->septiembre);
    }

    /**
     * @return string
     */
    public function getTrimestre4()
    {
        return ($this->octubre+$this->noviembre+$this->diciembre);
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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->fecha_creacion = date('Y-m-d H:i:s');
            return true;
        } else {
            return false;
        }
    }
}
