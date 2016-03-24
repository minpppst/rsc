<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estatus".
 *
 * @property integer $id
 * @property string $estatus
 */
class Estatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estatus'], 'required'],
            [['estatus'], 'string', 'max' => 15]
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
