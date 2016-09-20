<?php

namespace backend\models;
use backend\models\AccionCentralizadaVariables;
use common\components\Notification;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property integer $id_usuario_destino
 * @property string $mensaje
 * @property string $img
 * @property string $date
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    const EVENT_NUEVO_PEDIDO = 'ObservacionProyecto';
      /**
     * @inheritdoc
     */
    public function init()
    {
        $this->on(self::EVENT_NUEVO_PEDIDO, [$this, 'notificacion_cargar']);
        
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_usuario_destino', 'mensaje', 'img'], 'required'],
            [['id_usuario', 'id_usuario_destino'], 'integer'],
            [['mensaje', 'img'], 'string'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
            'id_usuario_destino' => 'Id Usuario Destino',
            'mensaje' => 'Mensaje',
            'img' => 'Img',
            'date' => 'Date',
        ];
    }

    
     /**
     * Notificacion
     */
      public function notificacion_cargar($evento)
     {
        
           Notification::warning(Notification::KEY_FEEDBACK, $this->id_usuario_destino, $this->id);
        
     }

     /**
     * @return \yii\db\ActiveQuery
     */
     public function getIdUsuario()
    {
        return $this->hasOne(UserAccounts::className(), ['id' => 'id_usuario']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
     public function getIdUsuarioDestino()
    {
        return $this->hasOne(UserAccounts::className(), ['id' => 'id_usuario_destino']);
    }
}
