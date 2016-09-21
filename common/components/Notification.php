<?php
    namespace common\components;

    use Yii;
    use common\models\ProyectoPedido;
    use common\models\AccionCentralizadaPedido;
    use common\models\AcEspUej;
    use machour\yii2\notifications\models\Notification as BaseNotification;
    use backend\models\feedback;

    class Notification extends BaseNotification
    {

        /**
         * Un nuevo pedido o requerimiento
         */
        const KEY_NUEVO_PEDIDO = 'nuevo_pedido';
        const KEY_NUEVO_PEDIDO_ACC = 'pedido_accion_centralizada';
        const KEY_PEDIDO_ACC_APROBADO= 'pedido_acc_aprobado';
        const KEY_FEEDBACK ='observacion';

        /**
         * @var array Holds all usable notifications
         */
        public static $keys = [
            self::KEY_NUEVO_PEDIDO,
            self::KEY_NUEVO_PEDIDO_ACC,
            self::KEY_PEDIDO_ACC_APROBADO,
            self::KEY_FEEDBACK,
        ];

        /**
         * @inheritdoc
         */
        public function getTitle()
        {
            switch ($this->key) {
                case self::KEY_NUEVO_PEDIDO:
                $pedido = ProyectoPedido::findOne($this->key_id);
                
                    return Yii::t('app', 'Nuevo pedido/requerimiento');
                    break;
                    case self::KEY_NUEVO_PEDIDO_ACC:
                    $pedido = AccioncentralizadaPedido::findOne($this->key_id);
                    return Yii::t('app', 'Nuevo Requerimiento Central');
                    break;
                    case self::KEY_PEDIDO_ACC_APROBADO:
                    $acc_uej=AcEspUej::findOne($this->key_id);
                    $pedido = $acc_uej->nombreunidadejecutora;
                    return yii::t('app', 'Aprobación De Requerimientos');
                    break;
                    
                    case self::KEY_FEEDBACK : 
                    return yii::t('app', 'Observacion Proyecto');
                    break;
            }
        }

        /**
         * @inheritdoc
         */
        public function getDescription()
        {
            switch ($this->key) {
                case self::KEY_NUEVO_PEDIDO:
                    $pedido = ProyectoPedido::findOne($this->key_id);
                    
                    return Yii::t('app', 'Pedido #{pedido} por {usuario}', [
                        'pedido' => $pedido->id,
                        'usuario' => $pedido->asignado0->usuario->username
                    ]);
                    break;
                    case self::KEY_NUEVO_PEDIDO_ACC:
                    $pedido = AccionCentralizadaPedido::findOne($this->key_id);
                    
                    return Yii::t('app', 'Pedido #{pedido} por {usuario}', [
                        'pedido' => isset($pedido->id) ? $pedido->id : '',
                        'usuario' => isset($pedido->asignado0->nombreUsuario) ? isset($pedido->asignado0->nombreUsuario) : ''
                    ]);
                    break;

                    case self::KEY_PEDIDO_ACC_APROBADO:
                    $acc_uej=AcEspUej::findOne($this->key_id);
                    $pedido = $acc_uej->Nombreunidadejecutora;
                    $aprobado = $acc_uej->aprobado==1 ? 'aprobados' : 'no aprobados';
                    return Yii::t('app', 'Pedidos De Unidad Ejecutora '.$pedido.' fuerón '.$aprobado.''
                        );
                    break;

                    case self::KEY_FEEDBACK:
                    $feedback= Feedback::findOne($this->key_id);
                    return Yii::t('app','Observación del proyecto #{id} 
                        <div class="actions pull-right">
                        <span class="notification-seen fa fa-eye"  onclick="feedback({id})"></span>
                        </div>
                        ',
                        [
                        'id' => $feedback->id,
                        ]
                        );
                    break;
            }
        }

        /**
         * @inheritdoc
         */
        public function getRoute()
        {
            switch ($this->key) {
                case self::KEY_NUEVO_PEDIDO:
                    $pedido = ProyectoPedido::findOne($this->key_id);
                    
                    return ['/proyecto-pedido/view', 
                        'id' => $pedido->id];
                        break;
                case self::KEY_NUEVO_PEDIDO_ACC:
                    $pedido = AccionCentralizadaPedido::findOne($this->key_id);
                    
                    return ['/accion-centralizada-pedido/view', 
                        
                        'id' => $this->key_id];
                        break;
                case self::KEY_PEDIDO_ACC_APROBADO:
                return['/'];
                break;

                

            };
        }

    }

?>