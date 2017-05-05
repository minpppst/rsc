<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "unidad_medida_productos".
 *
 * @property integer $id
 * @property string $unidad_medida
 * @property integer $tipo
 * @property integer $estatus
 */
class UnidadMedidaProductos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unidad_medida_productos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unidad_medida'], 'required'],
            [['tipo', 'estatus'], 'integer'],
            [['unidad_medida'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unidad_medida' => 'Unidad Medida',
            'tipo' => 'Tipo',
            'estatus' => 'Estatus',
        ];
    }
}
