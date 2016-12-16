<?php

namespace backend\models;
use common\models\UnidadEjecutora;
use common\models\UnidadMedida;
use common\models\ProyectoVariableImpacto;
use common\models\Ambito;

use Yii;

/**
 * This is the model class for table "proyecto_variables".
 *
 * @property integer $id
 * @property string $nombre_variable
 * @property integer $unidad_medida
 * @property integer $localizacion
 * @property string $definicion
 * @property string $base_calculo
 * @property string $fuente_informacion
 * @property integer $unidad_ejecutora
 * @property integer $accion_especifica
 * @property integer $impacto
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 * @property string $fecha_eliminacion
 *
 * @property ProyectoVariableLocalizacion[] $proyectoVariableLocalizacions
 * @property ProyectoVariableResponsable[] $proyectoVariableResponsables
 * @property ProyectoVariableUsuarios[] $proyectoVariableUsuarios
 * @property ProyectoAccionEspecifica $accionEspecifica
 * @property UnidadEjecutora $unidadEjecutora
 * @property UnidadMedida $unidadMedida
 */
class ProyectoVariables extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_variables';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_variable', 'unidad_medida', 'localizacion', 'definicion', 'base_calculo', 'fuente_informacion', 'unidad_ejecutora', 'accion_especifica', 'impacto'], 'required'],
            [['nombre_variable', 'definicion', 'base_calculo', 'fuente_informacion'], 'string'],
            [['unidad_medida', 'localizacion', 'unidad_ejecutora', 'accion_especifica', 'impacto'], 'integer'],
            [['fecha_creacion', 'fecha_modificacion', 'fecha_eliminacion'], 'safe'],
            [['accion_especifica'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectoAccionEspecifica::className(), 'targetAttribute' => ['accion_especifica' => 'id']],
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
            'unidad_ejecutora' => 'Unidad Ejecutora',
            'accion_especifica' => 'Accion Especifica',
            'impacto' => 'Impacto',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_modificacion' => 'Fecha Modificacion',
            'fecha_eliminacion' => 'Fecha Eliminacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoVariableLocalizacions()
    {
        return $this->hasMany(ProyectoVariableLocalizacion::className(), ['id_variable' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmbito()
    {
        return $this->hasOne(Ambito::className(), ['id' => 'localizacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoVariableResponsables()
    {
        return $this->hasOne(ProyectoVariableResponsable::className(), ['id_variable' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoVariableUsuarios()
    {
        return $this->hasMany(ProyectoVariableUsuarios::className(), ['id_variable' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionEspecifica()
    {
        return $this->hasOne(ProyectoAccionEspecifica::className(), ['id' => 'accion_especifica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImpacto0()
    {
        return $this->hasOne(ProyectoVariableImpacto::className(), ['id' => 'impacto']);
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
     * obtener las acciones especificas
     * @param int $accion
     * @return array
     */
    public function BuscarAcciones($accion)
    {

          $ace = ProyectoAccionEspecifica::find()
            ->select(["proyecto_accion_especifica.id", "CONCAT(proyecto_accion_especifica.codigo_accion_especifica,' - ',proyecto_accion_especifica.nombre) AS name"])
            ->innerjoin('proyecto', 'proyecto.id=proyecto_accion_especifica.id_proyecto')
            ->where(['proyecto.id' => $accion, 'proyecto_accion_especifica.estatus' => 1])
            ->asArray()
            ->all();
            return $ace;
    }

    /**
     * obtener las unidades ejecutoras asociadas a una accion especifica
     * @param int $acc_uej
     * @return array
     */
    public function ObtenerUnidadesEJ($acc_uej)
    {
      $unidad= UnidadEjecutora::find()
                ->select(["unidad_ejecutora.id as id", "CONCAT(unidad_ejecutora.codigo_ue, ' - ',unidad_ejecutora.nombre) as name"])
                ->innerjoin('proyecto_accion_especifica', 'proyecto_accion_especifica.id_unidad_ejecutora=unidad_ejecutora.id')
                ->where(['proyecto_accion_especifica.id' => $acc_uej])
                ->asArray()
                ->all();

                return $unidad;

    }

    /**
     * obtener los usuarios asociados a la unidad ejecutora y accion especifica
     * @param int $accion
     * @return array
     */
    public function BuscarUserUej($accion)
    {

          $ace = ProyectoAccionEspecifica::find()
            ->select(["user_accounts.id", "user_accounts.username as name"])
            ->innerjoin('proyecto_usuario_asignar', 'proyecto_usuario_asignar.accion_especifica_id=proyecto_accion_especifica.id')
            ->innerjoin('user_accounts', 'user_accounts.id=proyecto_usuario_asignar.usuario_id')
            ->where(['proyecto_accion_especifica.id_unidad_ejecutora' => $accion['proyectovariables-unidad_ejecutora'], 'proyecto_accion_especifica.id' => $accion['proyectovariables-accion_especifica']])
            ->asArray()
            ->all();

            return $ace;
    }
}
