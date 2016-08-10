<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tipo_entidad".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property UePartidaEntidad[] $uePartidaEntidads
 */
class TipoEntidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_entidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUePartidaEntidads()
    {
        return $this->hasMany(UePartidaEntidad::className(), ['id_tipo_entidad' => 'id']);
    }
}
