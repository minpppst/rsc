<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sub_sector".
 *
 * @property integer $id
 * @property string $sub_sector
 */
class SubSector extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_sector';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sub_sector'], 'required'],
            [['sub_sector'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sub_sector' => 'Sub Sector',
        ];
    }
}
