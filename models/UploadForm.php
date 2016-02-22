<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $importFile;

    public function rules()
    {
        return [
            [['importFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'csv'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'importFile' => 'Importar Archivo',
        ];
    }
    
}