<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accion_centralizada".
 *
 * @property integer $id
 * @property string $codigo_accion
 * @property string $codigo_accion_sne
 * @property string $nombre_accion
 * @property integer $estatus
 * @property string $fecha_inicio
 * @property string $fecha_fin
 *
 * @property AcVariable[] $acVariables
 */
class AccionCentralizada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        
        return [
            [['codigo_accion', 'codigo_accion_sne'],'unique'],
            [['codigo_accion', 'codigo_accion_sne', 'nombre_accion', 'estatus', 'fecha_inicio', 'fecha_fin'], 'required'],
            //[['fecha_inicio', 'fecha_fin'], 'date', 'format'=>'Y-m-d'],
            ['fecha_inicio', 'compare', 'compareAttribute'=>'fecha_fin','operator'=>'<', 'message'=>'Fecha Inicial Debe Ser Menor A Fecha Final'],
            [['codigo_accion', 'codigo_accion_sne'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo_accion' => 'Codigo Accion',
            'codigo_accion_sne' => 'Codigo Accion SNE',
            'nombre_accion' => 'Nombre Accion',
            'estatus' => 'Estatus',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
             'nombreEstatus' => 'Estatus'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcVariables()
    {
        return $this->hasMany(AcVariable::className(), ['id_ac' => 'id']);
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

}
