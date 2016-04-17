<?php
    namespace common\components;

    use Yii;
    use common\models\ProyectoPedido;
    use machour\yii2\notifications\models\Notification as BaseNotification;

    class Notification extends BaseNotification
    {

        /**
         * Un nuevo pedido o requerimiento
         */
        const KEY_NUEVO_PEDIDO = 'nuevo_pedido';

        /**
         * @var array Holds all usable notifications
         */
        public static $keys = [
            self::KEY_NUEVO_PEDIDO,
        ];

        /**
         * @inheritdoc
         */
        public function getTitle()
        {
            switch ($this->key) {
                case self::KEY_NUEVO_PEDIDO:
                    return Yii::t('app', 'Nuevo pedido/requerimiento');
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
                        'usuario' => $pedido->asignado0->usuario0->username
                    ]);
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
                    return ['/proyecto-pedido/pedido', 
                        'ue' => $pedido->asignado0->unidad_ejecutora,
                        'id' => $this->key_id];
            };
        }

    }

?>