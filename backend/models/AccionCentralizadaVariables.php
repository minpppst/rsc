<?php

namespace backend\models;

use common\models\UnidadEjecutora;
use common\models\UnidadMedida;
use backend\models\LocalizacionAccVariable;
use Yii;

/**
 * This is the model class for table "accion_centralizada_variables".
 *
 * @property integer $id
 * @property string $nombre_variable
 * @property integer $unidad_medida
 * @property integer $localizacion
 * @property string $definicion
 * @property string $base_calculo
 * @property string $fuente_informacion
 * @property integer $meta_programada_variable
 * @property integer $unidad_ejecutora
 * @property integer $acc_accion_especifica
 *
 * @property AccionCentralizadaAcEspecificaUej $accAccionEspecifica
 * @property UnidadEjecutora $unidadEjecutora
 * @property UnidadMedida $unidadMedida
 * @property LocalizacionAccVariable[] $localizacionAccVariables
 */
class AccionCentralizadaVariables extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada_variables';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_variable', 'unidad_medida', 'localizacion', 'definicion', 'base_calculo', 'fuente_informacion', 'unidad_ejecutora', 'acc_accion_especifica'], 'required'],
            [['nombre_variable', 'definicion', 'base_calculo', 'fuente_informacion'], 'string'],
            //[['unidad_medida', 'localizacion', 'responsable', 'meta_programada_variable', 'unidad_ejecutora', 'acc_accion_especifica'], 'integer'],
            [['acc_accion_especifica'], 'exist', 'skipOnError' => true, 'targetClass' => AcAcEspec::className(), 'targetAttribute' => ['acc_accion_especifica' => 'id']],
            [['unidad_ejecutora'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadEjecutora::className(), 'targetAttribute' => ['unidad_ejecutora' => 'id']],
            [['unidad_medida'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadMedida::className(), 'targetAttribute' => ['unidad_medida' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_variable' => 'Nombre Variable',
            'unidad_medida' => 'Unidad Medida',
            'localizacion' => 'Localizacion',
            'definicion' => 'Definicion',
            'base_calculo' => 'Base Calculo',
            'fuente_informacion' => 'Fuente Informacion',
            'meta_programada_variable' => 'Meta Programada Variable',
            'unidad_ejecutora' => 'Unidad Ejecutora',
            'acc_accion_especifica' => 'Accion Especifica',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccAccionEspecifica()
    {
        return $this->hasOne(AcAcEspec::className(), ['id' => 'acc_accion_especifica']);
        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadEjecutora()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'unidad_ejecutora']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadMedida()
    {
        return $this->hasOne(UnidadMedida::className(), ['id' => 'unidad_medida']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalizacionAccVariables()
    {
        return $this->hasMany(LocalizacionAccVariable::className(), ['id_variable' => 'id']);
    }


    public function getResponsable()
    {
        return $this->hasOne(ResponsableAccVariable::className(), ['id_variable' => 'id']);
    }


    public function getLocal_variable(){

        $resultado=LocalizacionAccVariable::find()->andWhere('id_variable='.$this->id)->one();
        if($resultado!=null){
            return true;
        }
        else{
            return false;
        }

    }
    public function getLocal_variable_estados(){
            
            $count = LocalizacionAccVariable::find()->where("id_variable=".$this->id)->count();
            
            if($count<=24)
             return false;
            else
              return true;

                        }

    public function getNombreLocalizacion(){

        if($this->localizacion==0){
            return 'Nacional';

        }else{
            return 'Estadal';
        }
    }

    //obteenr las unidades ejecutoras asociadas a una acc
    public function ObtenerUnidadesEJ($acc_uej){
      $unidad= UnidadEjecutora::find()
                ->select(["unidad_ejecutora.id as id", "CONCAT(unidad_ejecutora.codigo_ue, ' - ',unidad_ejecutora.nombre) as name"])
                ->innerjoin('accion_centralizada_ac_especifica_uej', 'accion_centralizada_ac_especifica_uej.id_ue=unidad_ejecutora.id')
                ->where(['accion_centralizada_ac_especifica_uej.id_ac_esp' => $acc_uej])
                ->asArray()
                ->all();

                return $unidad;

    }


    //funcion para encontrar las acciones especificas
    public function BuscarACC($accion){

          $ace = AcAcEspec::find()
            ->select(["accion_centralizada_accion_especifica.id", "CONCAT(accion_centralizada_accion_especifica.cod_ac_espe,' - ',accion_centralizada_accion_especifica.nombre) AS name"])
            ->innerjoin('accion_centralizada', 'accion_centralizada.id=accion_centralizada_accion_especifica.id_ac_centr')
            ->where(['accion_centralizada.id' => $accion, 'accion_centralizada_accion_especifica.estatus' => 1])
            ->asArray()
            ->all();
            return $ace;




    }



    function uejecutoras($usuarios){



      //buscar si quitaron una unidad si es asi borrar la quitaron estatus 2
      
      if($usuarios==null){
        $usuarios='';

      }
      $ace = AccionCentralizadaVariablesUsuarios::find()
              ->select('accion_centralizada_variables_usuarios.id')
              ->where(['accion_centralizada_variables_usuarios.id_variable' => $this->id])
              ->andwhere(['accion_centralizada_variables_usuarios.estatus' => 1])
              ->andwhere(['not in', 'accion_centralizada_variables_usuarios.id_usuario', $usuarios])
              ->asArray()
              ->all();
        
        if($ace!=null){
            $model_cambiar= new AccionCentralizadaVariablesUsuarios;
        foreach ($ace as $key => $value) {
          //AccionCentralizadaVariablesUsuarios::deleteAll(['id' => $value]);
            $model_cambiar->usuario_eliminar($value);
          
        }
        }
        //buscar si agregaron una unidad si es asi almacenar las nuevas y guardar
        $ace = AccionCentralizadaVariablesUsuarios::find()
              ->select('accion_centralizada_variables_usuarios.id_usuario')
              ->where(['accion_centralizada_variables_usuarios.id_variable' => $this->id])
              ->andwhere(['accion_centralizada_variables_usuarios.estatus' => 1])
              ->andwhere(['in', 'accion_centralizada_variables_usuarios.id_usuario', $usuarios])
              ->asArray()
              ->all();
        
        
        $i=0;
        $tabla[]=null;
        foreach ($ace as $key => $value) {
          
        $tabla[]=$value['id_usuario'];
        
        }
        //si viene vacio
        if($usuarios==null){
          $usuarios=[];
        }

        
        $nuevo=array_diff($usuarios, $tabla);
        
        foreach ($nuevo as $key => $value) {
        $model_variable_usuario=new AccionCentralizadaVariablesUsuarios;
        $model_variable_usuario->id_usuario=$value;
        $model_variable_usuario->id_variable=$this->id;  
        $model_variable_usuario->save();
        }

        
      }


}
