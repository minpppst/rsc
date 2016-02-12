<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partida".
 *
 * @property integer $id
 * @property integer $partida
 * @property string $nombre
 * @property integer $estatus
 * @property ProyectoDistribucionPresupuestaria[] $proyectoDistribucionPresupuestarias
 */
class Partida extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partida';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partida', 'nombre','estatus'], 'required'],
            [['partida'], 'integer'],
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
            'partida' => 'Partida',
            'nombre' => 'Nombre',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoDistribucionPresupuestarias()
    {
        return $this->hasMany(ProyectoDistribucionPresupuestaria::className(), ['id_partida' => 'id']);
    }
}
