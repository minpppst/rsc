<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materiales_servicios".
 *
 * @property integer $id
 * @property integer $id_se
 * @property string $nombre
 * @property integer $unidad_medida
 * @property integer $presentacion
 * @property string $precio
 * @property integer $iva
 * @property integer $estatus
 *
 * @property Presentacion $presentacion0
 * @property Se $idSe
 * @property UnidadMedida $unidadMedida
 * @property PedidoMaterialServicio[] $pedidoMaterialServicios
 */
class MaterialesServicios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'materiales_servicios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_se', 'nombre', 'unidad_medida', 'presentacion', 'precio', 'iva', 'estatus'], 'required'],
            [['id_se', 'unidad_medida', 'presentacion', 'iva', 'estatus'], 'integer'],
            [['precio'], 'number'],
            [['nombre'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_se' => 'Partida Sub-específica',
            'nombre' => 'Nombre',
            'unidad_medida' => 'Unidad de Medida',
            'presentacion' => 'Presentación',
            'precio' => 'Precio',
            'iva' => 'IVA',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentacion0()
    {
        return $this->hasOne(Presentacion::className(), ['id' => 'presentacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSe()
    {
        return $this->hasOne(Se::className(), ['id' => 'id_se']);
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
    public function getPedidoMaterialServicios()
    {
        return $this->hasMany(PedidoMaterialServicio::className(), ['id_material' => 'id']);
    }
}
