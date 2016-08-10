<?php

namespace backend\models;

use Yii;
use common\models\UnidadEjecutora;
use common\models\PartidaPartida;
use common\models\MaterialesServicios;

/**
 * This is the model class for table "ue_partida_entidad".
 *
 * @property integer $id
 * @property string $cuenta
 * @property string $partida
 * @property integer $id_ue
 * @property integer $id_tipo_entidad
 *
 * @property TipoEntidad $idTipoEntidad
 * @property UnidadEjecutora $idUe
 */
class UePartidaEntidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ue_partida_entidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuenta', 'partida', 'id_ue', 'id_tipo_entidad'], 'required'],
            [['id_ue', 'id_tipo_entidad'], 'integer'],
            [['cuenta'], 'string', 'max' => 1],
            [['partida'], 'string', 'max' => 2],
            [['cuenta', 'partida', 'id_ue', 'id_tipo_entidad'], 'unique', 'targetAttribute' => ['cuenta', 'partida', 'id_ue', 'id_tipo_entidad'], 'message' => 'The combination of Cuenta, Partida, Id Ue and Id Tipo Entidad has already been taken.'],
            [['id_tipo_entidad'], 'exist', 'skipOnError' => true, 'targetClass' => TipoEntidad::className(), 'targetAttribute' => ['id_tipo_entidad' => 'id']],
            [['id_ue'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadEjecutora::className(), 'targetAttribute' => ['id_ue' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cuenta' => 'Cuenta',
            'partida' => 'Partida',
            'id_ue' => 'Id Ue',
            'id_tipo_entidad' => 'Id Tipo Entidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoEntidad()
    {
        return $this->hasOne(TipoEntidad::className(), ['id' => 'id_tipo_entidad']);
    }

     public function getpartidaPartida()
    {
        return $this->hasOne(PartidaPartida::className(), ['cuenta' => 'cuenta', 'partida' => 'partida']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUe()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'id_ue']);
    }
    //eliminar por id
    public  function uej_eliminar($id){
        $model = UePartidaEntidad::findOne($id);
        return $model->delete();
        
     }

    //agregar/quitar las unidades ejecutoras por combo
    public function UejEntidad($id_uej,$entidad){



      //buscar si quitaron una unidad si es asi borrar la quitaron
      
      if($id_uej==null){
        $id_uej='';

      }
      $ace = UePartidaEntidad::find()
              ->select('ue_partida_entidad.id')
              ->where(['cuenta' => $this->cuenta])
              ->andwhere(['partida' => $this->partida])
              ->andwhere(['id_tipo_entidad' => $entidad])
              ->andwhere(['not in', 'id_ue', $id_uej])
              ->asArray()
              ->all();
        
        if($ace!=null){
        $model_cambiar=new UePartidaEntidad;
        foreach ($ace as $key => $value) {
         $model_cambiar->uej_eliminar($value);
          
        }
        }
        //buscar si agregaron una unidad si es asi almacenar las nuevas y guardar
        $ace = UePartidaEntidad::find()
              ->select('id_ue')
              ->where(['cuenta' => $this->cuenta])
              ->andwhere(['partida' => $this->partida])
              ->andwhere(['id_tipo_entidad' => $entidad])
              ->andwhere(['in', 'id_ue', $id_uej])
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
        $model_uej=new UePartidaEntidad;
        $model_uej->id_ue=$value;
        $model_uej->cuenta=$this->cuenta;
        $model_uej->partida=$this->partida;
        $model_uej->id_tipo_entidad=$entidad;  
        $model_uej->save();
        }

        
      }



      public function obtener_uej_relacionadas($entidad,$cuenta,$partida)
     {
        $ue="";
        $uej=UePartidaEntidad::find()
        ->select(['unidad_ejecutora.nombre as name'])
        ->innerjoin('unidad_ejecutora', 'ue_partida_entidad.id_ue=unidad_ejecutora.id')
        ->where(['ue_partida_entidad.cuenta' => $cuenta])
        ->andWhere(['ue_partida_entidad.partida' => $partida])
        ->andwhere(['ue_partida_entidad.id_tipo_entidad' => $entidad])
        ->asArray()
        ->all();

        foreach ($uej as $key => $value) {
        $ue.=$value['name'].", ";
        }
        $ue = substr($ue, 0, -2);
        return $ue;
     }

     public function getMaterialesPartidaEntidad()
    {
        return $this->hasMany(MaterialesServicios::className(), ['cuenta' => 'cuenta', 'partida' => 'partida']);
    }
}
