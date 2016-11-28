<?php

namespace common\models;
use backend\models\Feedback;
use machour\yii2\notifications\models\Notification as BaseNotifications;
use machour\yii2\notifications\NotificationsModule;
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
class Notification extends BaseNotifications
{
       public  function getTitle () { return null; }  //Método abstracto sobreescrito en esta clase
       public  function getDescription () { return null; }  //Método abstracto sobreescrito en esta clase
       public  function getRoute () { return null; }  //Método abstracto sobreescrito en esta clase
    
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
     * @return \yii\db\ActiveQuery
    */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
    */
    public function getIdUserOrigin()
    {
        return $this->hasOne(User::className(), ['id' => 'user_origin']);
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
                return null;
            break;
         }
    }

    /**
    *@return string img
    */
    public function getImgObservacion()
    {
        return $this->idFeeback->img!=null ? $this->idFeeback->img : null;
    }

    /**
     * Creates a notification
     *
     * @param string $key
     * @param integer $user_id The user id that will get the notification
     * @param integer $key_id The foreign instance id
     * @param string $type
     * @return bool Returns TRUE on success, FALSE on failure
     * @throws \Exception
     */
    public static function notify($key, $user_id, $key_id = null, $type = self::TYPE_DEFAULT)
    {
        $class = self::className();
        $user_origin=Yii::$app->user->identity->id;
        return NotificationsModule::notify(new $class(), $key, $user_id, $key_id, $type, $user_origin);
    }

    /**
     * Creates a warning notification
     *
     * @param string $key
     * @param integer $user_id The user id that will get the notification
     * @param integer $key_id The notification key id
     * @return bool Returns TRUE on success, FALSE on failure
     */
    public static function warning($key, $user_id, $key_id = null)
    {
        return static::notify($key, $user_id, $key_id, self::TYPE_WARNING);
    }


}
