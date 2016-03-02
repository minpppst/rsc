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
 * @property PartidaSubEspecifica $idSe
 * @property UnidadMedida $unidadMedida
 * @property ProyectoPedido[] $proyectoPedidos
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
            'id_se' => 'Partida Sub-Específica',
            'nombre' => 'Nombre',
            'unidad_medida' => 'Unidad de Medida',
            'presentacion' => 'Presentación',
            'precio' => 'Precio',
            'iva' => 'IVA',
            'estatus' => 'Estatus',
            'codigoSubEspecifica' => 'Específica',
            'nombrePresentacion' => 'Presentación',
            'precioBolivar' => 'Precio',
            'ivaPorcentaje' => 'IVA'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentacion0()
    {
        return $this->hasOne(Presentacion::className(), ['id' => 'presentacion']);
    }

    public function getNombrePresentacion()
    {
        if($this->presentacion0 == null)
        {
            return null;
        }

        return $this->presentacion0->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSe()
    {
        return $this->hasOne(PartidaSubEspecifica::className(), ['id' => 'id_se']);
    }

    public function getCodigoSubEspecifica()
    {
        if($this->id_se == null)
        {
            return null;
        }

        $this->idSe->especifica;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadMedida()
    {
        return $this->hasOne(UnidadMedida::className(), ['id' => 'unidad_medida']);
    }

    public function getPrecioBolivar()
    {
        if($this->precio == null)
        {
            return null;
        }

        return \Yii::$app->formatter->asCurrency($this->precio);
    }

    public function getIvaPorcentaje()
    {
        if($this->iva == null)
        {
            return null;
        }

        return $this->iva.'%' ;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoPedidos()
    {
        return $this->hasMany(ProyectoPedido::className(), ['id_material' => 'id']);
    }
}
