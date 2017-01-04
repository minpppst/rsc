<?php

namespace backend\models;
use johnitvn\userplus\base\models\UserAccounts;
use common\models\UnidadEjecutora;
use Yii;

/**
 * This is the model class for table "proyecto_variable_usuarios".
 *
 * @property integer $id
 * @property integer $id_variable
 * @property integer $id_usuario
 * @property integer $estatus
 * @property string $fecha_creacion
 * @property string $fecha_eliminacion
 *
 * @property ProyectoVariables $idVariable
 * @property UserAccounts $idUsuario
 */
class ProyectoVariableUsuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_variable_usuarios';
    }

    /*
    *Guargar los cambios hechos(auditoria)
    */
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
            [['id_variable', 'id_usuario'], 'required'],
            [['id_variable', 'id_usuario', 'estatus'], 'integer'],
            [['fecha_creacion', 'fecha_eliminacion'], 'safe'],
            [['id_variable'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectoVariables::className(), 'targetAttribute' => ['id_variable' => 'id']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccounts::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_variable' => 'Id Variable',
            'id_usuario' => 'Id Usuario',
            'estatus' => 'Estatus',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_eliminacion' => 'Fecha Eliminacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdVariable()
    {
        return $this->hasOne(ProyectoVariables::className(), ['id' => 'id_variable']);
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
    public function getIdUEJ()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'oficina']);
    }

    /**
     * Guardar los usuarios del combo de variables selcet2  solamente al momento de crear variable
     * @param int $id_variable, $id_usuario
     * @return bool
     */
     function UsuariosAgregar($id_variable, $id_usuario){

        $model_usuarios=new ProyectoVariableUsuarios;
        $model_usuarios->id_usuario=$id_usuario;
        $model_usuarios->id_variable=$id_variable;
        $model_usuarios->id=$this->id;
        if($model_usuarios->save())
        {
            return true;
        }
        else
        {
            return false;
        }

     }

     /**
     * operacion para agregar o eliminar los usuarios que vienen del combo select de variables
     * @param array $usuario
     * @param int $model
     * @return Mixed
     */
    public function UsuariosModificar($usuarios, $model)
    {
      //buscar si quitaron un usuario si es asi borrar la que quitaron
      
      if($usuarios==null)
      {
        $usuarios='';

      }
      $ace = ProyectoVariableUsuarios::find()
            ->select('proyecto_variable_usuarios.id')
            ->where(['proyecto_variable_usuarios.id_variable' => $model])
            ->andwhere(['not in', 'proyecto_variable_usuarios.id_usuario', $usuarios])
            ->asArray()
            ->all();


      //si encontro algo, es que quitaron un usuario por ende se debe eliminar
      if($ace!=null)
      {
        $model_cambiar= new ProyectoVariableUsuarios;
        foreach ($ace as $key => $value) {
          if(!$model_cambiar->eliminar($value['id']))
          {
            return false;
          }
          
        }
      }
      
      //buscar si agregaron un usuario si es asi almacenar las nuevos y guardar
      $ace = ProyectoVariableUsuarios::find()
            ->select('proyecto_variable_usuarios.id_usuario as id')
            ->where(['proyecto_variable_usuarios.id_variable' => $model])
            ->andwhere(['in', 'proyecto_variable_usuarios.id_usuario', $usuarios])
            ->asArray()
            ->all();
        
      
      $tabla[]=null;
      foreach ($ace as $key => $value)
      {
        $tabla[]=$value['id'];
      }
      //si viene vacio
      if($usuarios==null)
      {
        $usuarios=[];
      }
        
      //se comparan, si en nuevo aparecen usuarios estos serian
      //los nuevos usuarios que hay que agregar
      $nuevo=array_diff($usuarios, $tabla);
      foreach ($nuevo as $key => $value) 
      {
        $model_variable_usuario=new ProyectoVariableUsuarios;
        $model_variable_usuario->id_usuario=$value;
        $model_variable_usuario->id_variable=$model;  
        if(!$model_variable_usuario->save())
        {
          return false;
        }
      }
      return true;
    }

    /** Eliminar el modelo, se agregar por si se piensa usar el fecha_eliminacion en vez de eliminar de verdad
    * @param integer id
    * @return booleano
    */
    public function eliminar($id)
    {
        $model=ProyectoVariableUsuarios::findOne($id);
        if($model!=null)
        {

          if($model->delete())
          {
              return true;
          }
          else
          {
              return false;
          }

        }
        else
        {
          return false;
        }
    }

    /**Obtener los usuarios asociados a una variable
    * @param integer id
    * @return array de usuarios(name)
    */
    public function ObtenerUsuarioVariables($id)
    {
      $ue="";
      $uej=ProyectoVariableUsuarios::find()
      ->select(['user_accounts.username as name'])
      ->innerjoin('user_accounts', 'user_accounts.id=proyecto_variable_usuarios.id_usuario')
      ->where(['proyecto_variable_usuarios.id_variable' => $id])
      ->andwhere(['proyecto_variable_usuarios.estatus' => 1])
      ->asArray()
      ->all();
      foreach ($uej as $key => $value)
      {
      $ue.=$value['name'].", ";
      }
      $ue = substr($ue, 0, -2);        
      return $ue;
    }
}
