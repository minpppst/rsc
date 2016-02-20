<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "es".
 *
 * @property integer $id
 * @property integer $id_ge
 * @property string $codigo_es
 * @property string $nombre
 * @property integer $estatus
 *
 * @property Ge $idGe
 * @property Se[] $ses
 */
class Es extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'es';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ge', 'codigo_es', 'nombre', 'estatus'], 'required'],
            [['id_ge', 'estatus'], 'integer'],
            [['codigo_es'], 'string', 'max' => 2],
            [['nombre'], 'string', 'max' => 60],
            ['codigo_es', 'match', 'pattern' => '/^[0-9][1-9]$/', 'message' => 'Debe escribir un número entre 01 y 99']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ge' => 'GE',
            'codigo_es' => 'ES',
            'nombre' => 'Nombre',
            'estatus' => 'Estatus',
            'partidaGe' => 'GE'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGe()
    {
        return $this->hasOne(Ge::className(), ['id' => 'id_ge']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSes()
    {
        return $this->hasMany(Se::className(), ['id_es' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartidaGe()
    {
        if($this->idGe == null)
        {
            return null;
        }

        return $this->idGe->codigo_ge;
    }
}
