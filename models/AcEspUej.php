<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ac_esp_uej".
 *
 * @property integer $id
 * @property integer $id_ue
 * @property integer $id_ac_esp
 *
 * @property AcEspUej $idAcEsp
 * @property AcEspUej[] $acEspUejs
 * @property UnidadEjecutora $idUe
 */
class AcEspUej extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ac_esp_uej';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ue', 'id_ac_esp'], 'required'],
            [['id_ue', 'id_ac_esp'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ue' => 'Id Ue',
            'id_ac_esp' => 'Id Ac Esp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAcEsp()
    {
        return $this->hasOne(AcEspUej::className(), ['id' => 'id_ac_esp']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcEspUejs()
    {
        return $this->hasMany(AcEspUej::className(), ['id_ac_esp' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUe()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'id_ue']);
    }
}
