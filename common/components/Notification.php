<?php
    namespace common\components;

    use Yii;
    use common\models\ProyectoPedido;
    use common\models\AccionCentralizadaPedido;
    use common\models\AccionCentralizada;
    use common\models\AcEspUej;
    use common\models\Proyecto;
    use common\models\ProyectoAccionEspecifica;
    //use machour\yii2\notifications\models\Notification as BaseNotification;
    use common\models\Notification as BaseNotification;
    use backend\models\feedback;

    class Notification extends BaseNotification
    {

        /**
         * Un nuevo pedido o requerimiento
         */
        const KEY_NUEVO_PEDIDO = 'nuevo_requerimiento';
        const KEY_PEDIDOAPROBADO = 'RequerimientoAprobado';
        const KEY_PEDIDODESAPROBADO = 'RequerimientoDesAprobado';
        const KEY_NUEVO_PEDIDO_ACC = 'NuevoRequerimientoAC';
        const KEY_ACPEDIDOAPROBADO = 'RequerimientoACAprobado';
        const KEY_ACPEDIDODESAPROBADO = 'RequerimientoACDesAprobado';
        const KEY_FEEDBACK ='observacion';
        const KEY_APROBAR ='Proyecto Aprobado';
        const KEY_DESAPROBAR ='Proyecto Desaprobado';
        const KEY_ACAPROBAR ='Acción Centralizada Aprobada';
        const KEY_ACDESAPROBAR ='Acción Centralizada Desaprobada';

        /**
         * @var array Holds all usable notifications
         */
        public static $keys = [
            self::KEY_NUEVO_PEDIDO,
            self::KEY_NUEVO_PEDIDO_ACC,
            self::KEY_PEDIDOAPROBADO,
            self::KEY_PEDIDODESAPROBADO,
            self::KEY_ACPEDIDOAPROBADO,
            self::KEY_ACPEDIDODESAPROBADO,
            self::KEY_FEEDBACK,
            self::KEY_APROBAR,
            self::KEY_DESAPROBAR,
            self::KEY_ACAPROBAR,
            self::KEY_ACDESAPROBAR,
        ];

        /**
         * @inheritdoc
         */
        public function getTitle()
        {
            switch ($this->key) {
                case self::KEY_NUEVO_PEDIDO:
                    //$pedido = ProyectoPedido::findOne($this->key_id);
                    return Yii::t('app', 'Nuevo Requerimiento');
                break;

                case self::KEY_PEDIDOAPROBADO:
                    //$pedido = ProyectoPedido::findOne($this->key_id);
                    return Yii::t('app', 'Aprobación De Requerimiento');
                break;

                case self::KEY_PEDIDODESAPROBADO:
                    //$pedido = ProyectoPedido::findOne($this->key_id);
                    return Yii::t('app', 'Desaprobación De Requerimiento');
                break;

                case self::KEY_ACPEDIDOAPROBADO:
                    //$pedido = AcEspUej::findOne($this->key_id);
                    return Yii::t('app', 'Aprobación De Requerimiento AC');
                break;

                case self::KEY_ACPEDIDODESAPROBADO:
                    //$pedido = AcEspUej::findOne($this->key_id);
                    return Yii::t('app', 'Desaprobación De Requerimiento AC');
                break;

                case self::KEY_NUEVO_PEDIDO_ACC:
                    $pedido = AccioncentralizadaPedido::findOne($this->key_id);
                    return Yii::t('app', 'Nuevo Requerimiento Central');
                break;

                case self::KEY_FEEDBACK : 
                    return yii::t('app', 'Observacion Proyecto');
                break;

                case self::KEY_APROBAR : 
                    return yii::t('app', 'Estatus De Proyecto Cambio');
                break;

                case self::KEY_DESAPROBAR : 
                    return yii::t('app', 'Estatus De Proyecto Cambio');
                break;

                case self::KEY_ACAPROBAR : 
                    return yii::t('app', 'Estatus De Acción Centralizada Cambio');
                break;

                case self::KEY_ACDESAPROBAR : 
                    return yii::t('app', 'Estatus De Acción Centralizada Cambio');
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
                    
                    return Yii::t('app', 'Requerimiento #{pedido} por {usuario}', [
                        'pedido' => $pedido->id,
                        'usuario' => $pedido->asignado0->usuario->username
                    ]);
                break;
                case self::KEY_PEDIDOAPROBADO:
                    $proyectoEspecifica= ProyectoAccionEspecifica::findOne($this->key_id);
                    
                    return Yii::t('app', 'Aprobado Requerimientos a {unidad}', [
                        'unidad' => $proyectoEspecifica->idUnidadEjecutora->nombre,
                    ]);
                break;

                case self::KEY_PEDIDODESAPROBADO:
                    $proyectoEspecifica = ProyectoAccionEspecifica::findOne($this->key_id);
                    
                    return Yii::t('app', 'Desaprobado Requerimientos a {unidad}', [
                        'unidad' => $proyectoEspecifica->idUnidadEjecutora->nombre,
                    ]);
                break;

                case self::KEY_ACPEDIDOAPROBADO:
                    $acc_uej=AcEspUej::findOne($this->key_id);
                    return Yii::t('app', 'Aprobado Requerimientos AC a {unidad}', [
                        'unidad' => $acc_uej->Nombreunidadejecutora,
                    ]);
                break;

                case self::KEY_ACPEDIDODESAPROBADO:
                    $acc_uej=AcEspUej::findOne($this->key_id);
                    return Yii::t('app', 'Desaprobado Requerimientos AC a {unidad}', [
                        'unidad' => $acc_uej->Nombreunidadejecutora,
                    ]);
                break;

                case self::KEY_NUEVO_PEDIDO_ACC:
                    $pedido = AccionCentralizadaPedido::findOne($this->key_id);
                    
                    return Yii::t('app', 'Requerimiento #{pedido} por {usuario}', [
                        'pedido' => isset($pedido->id) ? $pedido->id : '',
                        'usuario' => isset($pedido->nombreUsuario) ? $pedido->nombreUsuario : '',
                    ]);
                break;

                case self::KEY_FEEDBACK:
                    $feedback= Feedback::findOne($this->key_id);
                    //proceso para realizar el thumbails
                    $img=str_replace('data:image/png;base64,', '', $feedback->img);
                    $image = ImageCreateFromString(base64_decode($img));
                    $img = imagecreatetruecolor(25,20);
                    imagecopyresized($img,$image,0,0,0,0,25,20,imagesx($image),imagesy($image));
                    ob_start();
                    imagedestroy($image);
                    imagepng($img);
                    $png = ob_get_clean();
                    $uri = "data:image/png;base64," . base64_encode($png);
                    //fin del proceso, por ahora se mantiene asi, tal vez sea mejor almacenar en bd el thumbails.
                    //al momento de crear la observacion
                    //<span class="notification-seen fa fa-eye"  onclick="feedback({id})"></span>
                    return Yii::t('app','Observación del proyecto #{id}
                        <div class="actions pull-right">
                        <span><img onclick="feedback({id},{id_observacion})"  src="'.$uri.'" title="Ver Imagen"></img></span>
                        </div>
                        ',
                        [
                        'id_observacion' => $feedback->id,
                        'id' => $this->id,
                        ]
                        );
                break;

                case self::KEY_APROBAR:
                    $proyecto=Proyecto::findOne($this->key_id);
                    
                    return Yii::t('app', 'Aprobado El Proyecto #'.$proyecto->codigo_proyecto
                        );
                break;

                case self::KEY_DESAPROBAR:
                    $proyecto=Proyecto::findOne($this->key_id);
                    return Yii::t('app', 'Desaprobado El Proyecto #'.$proyecto->codigo_proyecto
                        );
                break;

                case self::KEY_ACAPROBAR:
                    $proyecto=AccionCentralizada::findOne($this->key_id);
                    return Yii::t('app', 'Aprobado La Acción Centraliada #'.$proyecto->codigo_accion
                        );
                break;

                case self::KEY_ACDESAPROBAR:
                    $proyecto=AccionCentralizada::findOne($this->key_id);
                    return Yii::t('app', 'Desaprobada La Acción Centralizada #'.$proyecto->codigo_accion
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