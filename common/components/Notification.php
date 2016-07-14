<?php
    namespace common\components;

    use Yii;
    use common\models\ProyectoPedido;
    use common\models\AccionCentralizadaPedido;
    use machour\yii2\notifications\models\Notification as BaseNotification;

    class Notification extends BaseNotification
    {

        /**
         * Un nuevo pedido o requerimiento
         */
        const KEY_NUEVO_PEDIDO = 'nuevo_pedido';
        const KEY_NUEVO_PEDIDO_ACC = 'pedido_accion_centralizada';

        /**
         * @var array Holds all usable notifications
         */
        public static $keys = [
            self::KEY_NUEVO_PEDIDO,
            self::KEY_NUEVO_PEDIDO_ACC,
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

            };
        }

    }

?>