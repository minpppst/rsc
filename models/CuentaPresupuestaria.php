<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cuenta_presupuestaria".
 *
 * @property integer $id
 * @property string $cuenta
 * @property string $nombre
 *
 * @property PartidaPartida[] $partidaPartidas
 */
class CuentaPresupuestaria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuenta_presupuestaria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuenta', 'nombre'], 'required'],
            [['cuenta'], 'string', 'max' => 1],
            [['nombre'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cuenta' => 'Cuenta',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartidaPartidas()
    {
        return $this->hasMany(PartidaPartida::className(), ['cuenta' => 'id']);
    }
}
