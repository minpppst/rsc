<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "proyecto_ae_meta".
 *
 * @property integer $id
 * @property integer $id_proyecto_accion_especifica
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
 * @property integer $status
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
            [['id_proyecto_accion_especifica', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'status'], 'required'],
            [['id_proyecto_accion_especifica', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'status'], 'integer'],
            [['fecha_creacion'], 'safe'],
            [['id_proyecto_accion_especifica'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectoAccionEspecifica::className(), 'targetAttribute' => ['id_proyecto_accion_especifica' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_proyecto_accion_especifica' => 'Id Proyecto Accion Especifica',
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
            'status' => 'Status',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyectoAccionEspecifica()
    {
        return $this->hasOne(ProyectoAccionEspecifica::className(), ['id' => 'id_proyecto_accion_especifica']);
    }
}
