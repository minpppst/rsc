<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ge".
 *
 * @property integer $id
 * @property integer $id_partida
 * @property string $codigo_ge
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
            [['id_partida', 'codigo_ge', 'nombre_ge', 'estatus'], 'required'],
            [['id_partida', 'estatus'], 'integer'],
            [['codigo_ge'], 'string', 'max' => 2],
            [['nombre_ge'], 'string', 'max' => 60],
            ['codigo_ge', 'match', 'pattern' => '/^[0-9][1-9]$/', 'message' => 'Debe escribir un número entre 01 y 99']
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
            'codigo_ge' => 'GE',
            'nombre_ge' => 'Nombre',
            'estatus' => 'Estatus',
            'codigoPartida' => 'Partida'
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoPartida()
    {
        if($this->idPartida == null)
        {
            return null;
        }

        return $this->idPartida->partida;
    }
}
