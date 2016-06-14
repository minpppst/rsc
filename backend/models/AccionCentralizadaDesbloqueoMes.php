<?php

namespace backend\models;
use frontend\models\AccionCentralizadaVariableEjecucion;
use Yii;

/**
 * This is the model class for table "accion_centralizada_desbloqueo_mes".
 *
 * @property integer $id
 * @property integer $id_ejecucion
 * @property integer $mes
 *
 * @property AccionCentralizadaVariableEjecucion $idEjecucion
 */
class AccionCentralizadaDesbloqueoMes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada_desbloqueo_mes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ejecucion', 'mes'], 'required'],
            [['id_ejecucion', 'mes'], 'integer'],
            [['id_ejecucion'], 'exist', 'skipOnError' => true, 'targetClass' => AccionCentralizadaVariableEjecucion::className(), 'targetAttribute' => ['id_ejecucion' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEjecucion()
    {
        return $this->hasOne(AccionCentralizadaVariableEjecucion::className(), ['id' => 'id_ejecucion']);
    }
}
