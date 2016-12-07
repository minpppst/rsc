<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "estatus_proyecto".
 *
 * @property integer $id
 * @property string $estatus
 */
class EstatusProyecto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estatus_proyecto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estatus'], 'required'],
            [['estatus'], 'unique'],
            [['estatus'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estatus' => 'Estatus',
        ];
    }
}
