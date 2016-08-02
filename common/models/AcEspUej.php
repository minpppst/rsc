<?php

namespace common\models;

use Yii;
use common\models\AcAcEspec;
use common\components\Notification;
/**
 * This is the model class for table "accion_centralizada_ac_especifica_uej".
 *
 * @property integer $id
 * @property integer $id_ue
 * @property integer $id_ac_esp
 * @property integer $estatus
 * @property integer $aprobado
 *
 * @property AcEspUej $idAcEsp
 * @property AcEspUej[] $acEspUejs
 * @property UnidadEjecutora $idUe
 */
class AcEspUej extends \yii\db\ActiveRecord
{

    const EVENT_PEDIDO_APROBADO = 'pedido_aprobado';

    
    public function init(){

        $this->on(self::EVENT_PEDIDO_APROBADO, [$this, 'notificacion_cargar']);
        $this->on(self::EVENT_PEDIDO_APROBADO, [$this, 'notificacion']);
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada_ac_especifica_uej';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ue', 'id_ac_esp'], 'required'],
            [['id_ue', 'id_ac_esp'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ue' => 'Unidad Ejecutora',
            'id_ac_esp' => 'Accion Especifica',
            'estatus' => 'Estatus',
            'aprobado' => 'Aprobado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAcEsp()
    {
        return $this->hasOne(AcAcEspec::className(), ['id' => 'id_ac_esp']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcEspUejs()
    {
        return $this->hasMany(AcEspUej::className(), ['id_ac_esp' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUe()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'id_ue']);
    }
    public function getIdAccionEspecifica()
    {
        return $this->hasOne(AcAcEspec::className(), ['id' => 'id_ac_esp']);
    }

    public function nombre_accion($accion){
         $especifica = AcAcEspec::find()->where(['id'=>$accion])->one();

         
         return $especifica->nombre;
    }


    public function getnombreunidadejecutora(){
        
        if($this->idUe == null)
        {
            return null;
        }

        return $this->idUe->nombre;//idAcCentr->nombre_accion;
    } 


public function getnombreaccion(){
        if($this->idAcEsp == null)
        {
            return null;
        }

        return $this->idAcEsp->nombre;
    }

    public function getnombrecentral(){
        
        if($this->idAcEsp == null)
        {
            return null;
        }

        return $this->idAcEsp->idAcCentr->nombre_accion;//idAcCentr->nombre_accion;
    }

    public function getCodigocentral(){
        
        if($this->idAcEsp == null)
        {
            return null;
        }

        return $this->idAcEsp->idAcCentr->codigo_accion;//idAcCentr->nombre_accion;
    }


    public function getPedidoEjecutado(){

    //buscar si la asignacion ya fue ejecutada
    $asignacion=AccionCentralizadaAsignar::find()
        ->select(['accion_centralizada_pedido.id'])
        ->innerjoin('accion_centralizada_pedido', 'accion_centralizada_pedido.asignado=accion_centralizada_asignar.id')
        ->where(['accion_centralizada_asignar.accion_especifica_ue' => $this->id])
        ->One();
        //print_r($asignacion);

        if($asignacion!=NULL){
            return 1;
        }else{
            return 0;
        }

    }


     public function toggleAprobar()
     {
        if($this->aprobado == 1)
        {
            $this->aprobado = 0;
        }
        else
        {
            $this->aprobado = 1;
        }
        
        if($this->save()){
        $this->trigger(AcEspUej::EVENT_PEDIDO_APROBADO);
        return true;

        
        }
        else
       return false; 
        }

      public  function uej_eliminar($id){
        $model = AcEspUej::findOne($id);
        $model->estatus=2;
        return $model->save();
     }



     public function obtener_uej_relacionadas($id)
     {
        $ue="";
        $uej=AcEspUej::find()
        ->select(['unidad_ejecutora.nombre as name'])
        ->innerjoin('unidad_ejecutora', 'accion_centralizada_ac_especifica_uej.id_ue=unidad_ejecutora.id')
        ->where(['accion_centralizada_ac_especifica_uej.id_ac_esp' => $id])
        ->andwhere(['accion_centralizada_ac_especifica_uej.estatus' => 1])
        ->asArray()
        ->all();
        foreach ($uej as $key => $value) {
        $ue.=$value['name'].", ";
        }
        $ue = substr($ue, 0, -2);
        return $ue;


     }



     public function notificacion($evento)
     {
        
        if($evento->name=='pedido_aprobado')
        Notification::notify(Notification::KEY_PEDIDO_ACC_APROBADO, 1, $this->id);

     }

      public function notificacion_cargar($evento)
     {
        
        
        if($evento->name=='pedido_aprobado'){
        
        //buscando los usuarios que tenga asignado esa unidad ejecutora y accion_especifica
        $usuarios =AcEspUej::find()
        ->select(["accion_centralizada_asignar.usuario"])
        ->innerjoin('accion_centralizada_asignar', 'accion_centralizada_ac_especifica_uej.id=accion_centralizada_asignar.accion_especifica_ue')
        ->where(['accion_centralizada_asignar.accion_especifica_ue' => $this->id])
        ->andWhere(['accion_centralizada_ac_especifica_uej.estatus' => 1])
        ->asArray()
        ->all();

        
        
        foreach ($usuarios as $key => $usuario) {
            
            Notification::notify(Notification::KEY_PEDIDO_ACC_APROBADO, $usuario['usuario'], $this->id);
        } 
        }
        
     }





}
