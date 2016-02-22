<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyecto_pedido".
 *
 * @property integer $id
 * @property integer $id_material
 * @property integer $enero
 * @property integer $febrero
 * @property integer $marzo
 * @property integer $abril
 * @property integer $mayo
 * @property integer $junio
 * @property integer $julio
 * @property integer $agosto
 * @property integer $septiembre
 * @property integer $octubre
 * @property integer $noviembre
 * @property integer $diciembre
 * @property string $precio
 * @property string $fecha_creacion
 * @property integer $id_usuario
 * @property integer $id_accion_especifica
 *
 * @property ProyectoAccionEspecifica $idAccionEspecifica
 * @property MaterialesServicios $idMaterial
 * @property UserAccounts $idUsuario
 */
class ProyectoPedido extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_pedido';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_material', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'precio', 'id_usuario', 'id_accion_especifica'], 'required'],
            [['id_material', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'id_usuario', 'id_accion_especifica'], 'integer'],
            [['precio'], 'number'],
            [['fecha_creacion'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_material' => 'Id Material',
            'enero' => 'Enero',
            'febrero' => 'Febrero',
            'marzo' => 'Marzo',
            'abril' => 'Abril',
            'mayo' => 'Mayo',
            'junio' => 'Junio',
            'julio' => 'Julio',
            'agosto' => 'Agosto',
            'septiembre' => 'Septiembre',
            'octubre' => 'Octubre',
            'noviembre' => 'Noviembre',
            'diciembre' => 'Diciembre',
            'precio' => 'Precio',
            'fecha_creacion' => 'Fecha Creacion',
            'id_usuario' => 'Id Usuario',
            'id_accion_especifica' => 'Id Accion Especifica',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAccionEspecifica()
    {
        return $this->hasOne(ProyectoAccionEspecifica::className(), ['id' => 'id_accion_especifica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMaterial()
    {
        return $this->hasOne(MaterialesServicios::className(), ['id' => 'id_material']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(UserAccounts::className(), ['id' => 'id_usuario']);
    }
}
