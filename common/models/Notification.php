<?php

namespace common\models;
use backend\models\Feedback;
use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property string $key
 * @property integer $key_id
 * @property string $type
 * @property integer $user_id
 * @property integer $seen
 * @property string $created_at
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'type', 'user_id', 'seen', 'created_at'], 'required'],
            [['key_id', 'user_id', 'seen'], 'integer'],
            [['created_at'], 'safe'],
            [['key', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'key_id' => 'Key ID',
            'type' => 'Type',
            'user_id' => 'User ID',
            'seen' => 'Seen',
            'created_at' => 'Created At',
        ];
    }

      /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFeeback()
    {
        return $this->hasOne(Feedback::className(), ['id' => 'key_id']);
    }

    /**
    *@return string
    */
    public function getResumen()
    {
         switch ($this->key) {
            case 'observacion':
                return $this->idFeeback->mensaje;
                 
            break;

            case 'ProyectoAprobado':
                
                $proyecto=Proyecto::findOne($this->key_id);
                $accion=$proyecto->aprobado==1 ? 'Aprobado' : 'Desaprobado';
                return Yii::t('app',  $accion.' Por Planificación El Proyecto #'.$proyecto->codigo_proyecto
                        );

            break;
            
             
            default:
                 # code...
            break;
         }
    }

    /**
    *@return string
    */
    public function getImgObservacion()
    {
        
        return $this->idFeeback->img;
    }


}
