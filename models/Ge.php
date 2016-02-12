<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ge".
 *
 * @property integer $id
 * @property integer $id_partida
 * @property integer $codigo_ge
 * @property string $nombre_ge
 * @property integer $estatus
 *
 * @property Es[] $es
 * @property Partida $idPartida
 */
class Ge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_partida', 'codigo_ge', 'nombre_ge'], 'required'],
            [['id_partida', 'codigo_ge', 'estatus'], 'integer'],
            [['nombre_ge'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_partida' => 'Partida',
            'codigo_ge' => 'Código',
            'nombre_ge' => 'Nombre',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEs()
    {
        return $this->hasMany(Es::className(), ['id_ge' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPartida()
    {
        return $this->hasOne(Partida::className(), ['id' => 'id_partida']);
    }
}
