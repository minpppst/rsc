<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "proyecto_variable_desbloqueo_mes".
 *
 * @property integer $id
 * @property integer $id_ejecucion
 * @property integer $mes
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 *
 * @property ProyectoVariableEjecucion $idEjecucion
 */
class ProyectoVariableDesbloqueoMes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_variable_desbloqueo_mes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ejecucion', 'mes'], 'required'],
            [['id_ejecucion', 'mes'], 'integer'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['id_ejecucion'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectoVariableEjecucion::className(), 'targetAttribute' => ['id_ejecucion' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ejecucion' => 'Id Ejecucion',
            'mes' => 'Mes',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_modificacion' => 'Fecha Modificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEjecucion()
    {
        return $this->hasOne(ProyectoVariableEjecucion::className(), ['id' => 'id_ejecucion']);
    }
}
