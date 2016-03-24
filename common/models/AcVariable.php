<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ac_variable".
 *
 * @property integer $id
 * @property integer $id_u_ej
 * @property string $nombre_variable
 *
 * @property UnidadEjecutora $idUEj
 */
class AcVariable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ac_variable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_u_ej', 'nombre_variable'], 'required'],
            [['id_u_ej'], 'integer'],
            [['nombre_variable'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_u_ej' => 'Id U Ej',
            'nombre_variable' => 'Nombre Variable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUEj()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'id_u_ej']);
    }
}
