<?php

namespace frontend\models;

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
            //['fecha_inicio', 'compare', 'compareAttribute'=>'fecha_fin','operator'=>'<', 'message'=>'Fecha Inicial Debe Ser Menor A Fecha Final'],
            [['codigo_accion', 'codigo_accion_sne'], 'string', 'max' => 45],
            ['fecha_inicio', 'formato_fecha'],
            ['fecha_fin', 'formato_fecha'],
        ];
    }


    public function formato_fecha($attribute,$params){

        switch ($attribute) {
            case 'fecha_inicio':
                
            if (!preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $this->fecha_inicio))
                    {
                        $this->addError($attribute, "El Formato De Fecha Debe Ser 'dd/mm/yyyy' ");
                        //$mensaje="El Formato De Fecha Debe Ser 'dd/mm/yyyy' ";
                    }else{
                      
                      

                      $date = explode('/', $this->fecha_inicio);
                      $this->fecha_inicio=$date[2]."/".$date[1]."/".$date[0];
                      
                      //validando rango
                      $date = explode('/', $this->fecha_fin);
                      $fecha2=$date[2]."/".$date[1]."/".$date[0];
                      $fecha1 = new \DateTime($this->fecha_inicio);
                      $fecha2 = new \DateTime($fecha2);
                    if($fecha1>$fecha2)
                        $this->addError($attribute, "Fecha Inicio Debe Ser Menor A Fecha Fin ");

                    }


                break;

                case  'fecha_fin':

                if(!preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $this->fecha_fin))
            {
                         $this->addError($attribute, "El Formato De Fecha Debe Ser 'dd/mm/yyyy' ");
                        
                    }else{
                      $date = explode('/', $this->fecha_fin);
                      $this->fecha_fin=$date[2]."/".$date[1]."/".$date[0];
                     
                      
                    }

            break;
            default:
            
                break;
        }
        

         


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
        $this->save(false);
    }

     /**
     * Colocar estatus en 1 "Activo"
     */
     public function activar()
     {
        $this->estatus = 1;
        $this->save(false);
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
