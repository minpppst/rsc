<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "proyecto_ae_meta".
 *
 * @property integer $id
 * @property integer $id_proyecto_ac_localizacion
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
 * @property integer $estatus
 * @property string $fecha_creacion
 *
 * @property ProyectoAccionEspecifica $idProyectoAccionEspecifica
 */
class ProyectoAeMeta extends \yii\db\ActiveRecord
{    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_ae_meta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto_ac_localizacion', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'estatus'], 'required'],
            [['id_proyecto_ac_localizacion', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'estatus'], 'integer'],
            [['fecha_creacion'], 'safe'],
            [['id_proyecto_ac_localizacion'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectoAcLocalizacion::className(), 'targetAttribute' => ['id_proyecto_ac_localizacion' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_proyecto_ac_localizacion' => 'Id Proyecto Accion Especifica',
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
            'estatus' => 'estatus',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyectoAcLocalizacion()
    {
        return $this->hasOne(ProyectoAcLocalizacion::className(), ['id' => 'id_proyecto_ac_localizacion']);
    }
}
