<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alcance_unidad_medida".
 *
 * @property integer $id
 * @property string $unidad_medida
 */
class AlcanceUnidadMedida extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alcance_unidad_medida';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unidad_medida'], 'required'],
            [['unidad_medida'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unidad_medida' => 'Unidad de medida',
        ];
    }
}
