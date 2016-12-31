<?php

namespace backend\models;

use Yii;
use johnitvn\userplus\base\models\UserAccounts;
use backend\models\AccionCentralizadaVariables;

/**
 * This is the model class for table "accion_centralizada_variables_usuarios".
 *
 * @property integer $id
 * @property integer $id_variable
 * @property integer $id_usuario
 * @property integer $estatus
 *
 * @property UserAccounts $idUsuario
 * @property AccionCentralizadaVariables $idVariable
 */
class AccionCentralizadaVariablesUsuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada_variables_usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_variable', 'id_usuario'], 'required'],
            [['id_variable', 'id_usuario'], 'integer'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccounts::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_variable'], 'exist', 'skipOnError' => true, 'targetClass' => AccionCentralizadaVariables::className(), 'targetAttribute' => ['id_variable' => 'id']],
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
        ];
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
    public function getIdVariable()
    {
        return $this->hasOne(AccionCentralizadaVariables::className(), ['id' => 'id_variable']);
    }

    /**
     * Guardar los usuarios del combo de variables solamente al momento de create
     * @param int $id_variable, $id_usuario
     * @return bool
     */
     function usuarios_agregar($id_variable, $id_usuario){

        $model_usuarios=new AccionCentralizadaVariablesUsuarios;
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
     * Eliminar los usuarios asociados a una variable
     * @param int $id
     * @return bool
     */
     public function usuario_eliminar($id)
     {
        $model = AccionCentralizadaVariablesUsuarios::findOne($id);
        if($model->delete())
        {
            return true;
        }
        else
        {
            return false;
        }
        //$model->estatus=2;
        //return $model->save();
     }

     /**
     * mostrar nombre de los usuarios asociados a las variables
     * @param int $id
     * @return string
     */
     public function obtener_usuario_variables($id)
     {
        $ue="";
        $uej=AccionCentralizadaVariablesUsuarios::find()
        ->select(['user_accounts.username as name'])
        ->innerjoin('user_accounts', 'user_accounts.id=accion_centralizada_variables_usuarios.id_usuario')
        ->where(['accion_centralizada_variables_usuarios.id_variable' => $id])
        ->andwhere(['accion_centralizada_variables_usuarios.estatus' => 1])
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
