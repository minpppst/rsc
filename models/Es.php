<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "es".
 *
 * @property integer $id
 * @property integer $id_ge
 * @property integer $codigo_es
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
            [['id_ge', 'codigo_es', 'nombre'], 'required'],
            [['id_ge', 'codigo_es', 'estatus'], 'integer'],
            [['nombre'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ge' => 'Id Ge',
            'codigo_es' => 'Codigo Es',
            'nombre' => 'Nombre',
            'estatus' => 'Estatus',
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
}
