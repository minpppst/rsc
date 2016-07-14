<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\AcEspUej;
/**
 * This is the model class for table "accion_centralizada_accion_especifica".
 *
 * @property integer $id
 * @property integer $id_ac_centr
 * @property string $cod_ac_espe
 * @property string $nombre
 * @property string $estatus
 * @property string $fecha_inicio 
 * @property string $fecha_fin
 *
 * @property AccionCentralizada $idAcCentr
 * @property AcVariable[] $acVariables
 */
class AcAcEspec extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada_accion_especifica';
    }

    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior'
        ];
    }


    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['id_ac_centr', 'cod_ac_espe', 'nombre', 'estatus', 'fecha_inicio', 'fecha_fin',], 'required'],
            [['id_ac_centr'], 'integer'],
            [['cod_ac_espe'], 'unique'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['id_ac_centr'], 'exist', 'skipOnError' => true, 'targetClass' => AccionCentralizada::className(), 'targetAttribute' => ['id_ac_centr' => 'id']],
            
            //[['nombre'], 'string'], no valida campos largos
            [['cod_ac_espe'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ac_centr' => 'Id Accion Centralizada',
            'cod_ac_espe' => 'Cod. Accion Especifica',
            'nombre' => 'Nombre Accion Especifica',
            'estatus' => 'Estatus',
            'nombreEstatus' => 'Estatus'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAcCentr()
    {
        return $this->hasOne(AccionCentralizada::className(), ['id' => 'id_ac_centr']);
    }

    public function getIdAccuej()
    {
        return $this->hasmany(AcEspUej::className(), ['id_ac_esp' => 'id']);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcVariables()
    {
        return $this->hasMany(AcVariable::className(), ['id_ac_esp' => 'id']);
    }

    public function existe_uej(){
        //$resultado=AcEspUej::find()->select('id')->where('=','id_ac_esp',$this->id);
        $resultado =ArrayHelper::map(AcEspUej::find()->limit(1)->where('id_ac_esp= :id', ['id'=>$this->id])->all(),'id','id_ue');
        if(count($resultado)>0){
        return(1);}
    else{
        return(0);
    }
    }


    public   function getnombreEstatus(){
                              return ($this->estatus == 1)? 'Activo':'Inactivo';
                      }


    public function desactivar()
    {
        $this->estatus = 0;
        $this->save();
    }

     /**
     * Colocar estatus en 1 "Activo"
     */
     public function activar()
     {
        $this->estatus = 1;
        $this->save();
     }

     /**
      * Activar o desactivar
      */
     public function toggleActivo()
     {
        if($this->estatus == 1)
        {
            $this->desactivar();
        }
        else
        {
            $this->activar();
        }

        return true;
     }



     function uejecutoras($id_uej){



      //buscar si quitaron una unidad si es asi borrar la quitaron
      
      if($id_uej==null){
        $id_uej='';

      }
      $ace = AcEspUej::find()
              ->select('accion_centralizada_ac_especifica_uej.id')
              ->where(['accion_centralizada_ac_especifica_uej.id_ac_esp' => $this->id])
              ->andwhere(['accion_centralizada_ac_especifica_uej.estatus' => 1])
              ->andwhere(['not in', 'accion_centralizada_ac_especifica_uej.id_ue', $id_uej])
              ->asArray()
              ->all();
        
        if($ace!=null){
        $model_cambiar=new AcEspUej;
        foreach ($ace as $key => $value) {
          //AcEspUej::deleteAll(['id' => $value]);
          $model_cambiar->uej_eliminar($value);
          
        }
        }
        //buscar si agregaron una unidad si es asi almacenar las nuevas y guardar
        $ace = AcEspUej::find()
              ->select('accion_centralizada_ac_especifica_uej.id_ue')
              ->where(['accion_centralizada_ac_especifica_uej.id_ac_esp' => $this->id])
              ->andwhere(['accion_centralizada_ac_especifica_uej.estatus' => 1])
              ->andwhere(['in', 'accion_centralizada_ac_especifica_uej.id_ue', $id_uej])
              ->asArray()
              ->all();
        
        
        $i=0;
        $tabla[]=null;
        foreach ($ace as $key => $value) {
          
        $tabla[]=$value['id_ue'];
        
        }

        //si viene vacio
        if($id_uej==null){
          $id_uej=[];
        }
        $nuevo=array_diff($id_uej, $tabla);
        
        foreach ($nuevo as $key => $value) {
        $model_uej=new AcEspUej;
        $model_uej->id_ue=$value;
        $model_uej->id_ac_esp=$this->id;  
        $model_uej->save();
        }

        
      }


      public function uejecutoras_crear($id_ue){
        
        $model_uej=new AcEspUej;
        $model_uej->id_ue=$id_ue;
        $model_uej->id_ac_esp=$this->id;
        if($model_uej->save()){
          return true;
        }else{
          return false;
        }
      }
}
