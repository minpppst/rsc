<?php

namespace common\models;
//use machour\yii2\notifications\models\Notification;
use Yii;

use common\models\AccionCentralizadaAsignar;
use common\models\MaterialesServicios;
use common\components\Notification as Notificaciones;

/**
 * This is the model class for table "accion_centralizada_pedido".
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
 * @property integer $asignado
 * @property integer $estatus
 *
 * @property AccionCentralizadaAsignar $asignado0
 * @property MaterialesServicios $idMaterial
 */
class AccionCentralizadaPedido extends \yii\db\ActiveRecord
{
    /**
     * Constante que guarda el nombre del evento
     */
    const EVENT_NUEVO_PEDIDO = 'evento_nuevo_pedido';
     /**
     * @inheritdoc
     */
    public function init()
    {
        $this->on(self::EVENT_NUEVO_PEDIDO, [$this, 'notificacion_cargar']);
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada_pedido';
    }

   

    /**
     * @inheritdoc
     */
    public function rules()
    {
       return [
            [['id_material',  'precio', 'iva', 'asignado', 'estatus'], 'required'],
            [['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'],  'default', 'value' => '0'],
            [['id_material', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'asignado', 'estatus'], 'integer', 'min' => 0],
            //[['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'],   'min' => 0],
            [['id_material'], 'uniques'],
            [['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'numero_ingresado'],
            [['precio'], 'number'],
            [['fecha_creacion'], 'safe']
        ];
    }

    /** 
    * Buscar que los materiales que se cargen sean unicos por unidad ejecutora
    * @param int $attribute
    **/
    public function uniques($attribute)
    {
        $existe=AccionCentralizadaAsignar::find()
        ->Innerjoin('accion_centralizada_pedido','asignado=accion_centralizada_asignar.id')
        ->Innerjoin('accion_centralizada_ac_especifica_uej','accion_centralizada_asignar.accion_especifica_ue=accion_centralizada_ac_especifica_uej.id')
        ->where(['accion_centralizada_pedido.id_material' =>$this->id_material])
        ->andWhere(['accion_centralizada_ac_especifica_uej.id_ue' => $this->asignado0->accion_centralizada_ac_especifica_uej->id_ue])
        ->andWhere(['accion_centralizada_ac_especifica_uej.id_ac_esp' => $this->asignado0->accion_centralizada_ac_especifica_uej->id_ac_esp])
        ->all();

        if($existe!=null && $this->isNewRecord)
        {
            $this->addError($attribute, 'Error, Material Ya Existe');
        }
    }

    /** 
    * @param int $attribute
    * @return mixed
    **/
    public function numero_ingresado($attribute)
    {

        if($this->enero<=0 && $this->febrero<=0 && $this->marzo<=0 && $this->abril<=0 && $this->mayo<=0 && $this->junio<=0 && $this->julio<=0 && $this->agosto<=0 && $this->septiembre<=0 && $this->octubre<=0 && $this->noviembre<=0 && $this->diciembre<=0 )
             $this->addError($attribute, 'Error, Necesita Cargar Al Menos Una Cantidad Positiva En Uno De Los Meses');

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_material' => 'Material',
            'nombreMaterial' => 'Material/Servicio',
            'trimestre1' => 'Trimestre I',
            'trimestre2' => 'Trimestre II',
            'trimestre3' => 'Trimestre III',
            'trimestre4' => 'Trimestre IV',
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
            'fecha_creacion' => 'Fecha de Creación',
            'asignado' => 'ID de la asignacion (Usuario-UE-AC)',
            'estatus' => 'Estatus',
            'nombreEstatus' => 'Estatus',
            'nombreUsuario' => 'Usuario',
            'subTotal' => 'Sub-Total',
            'iva' => 'IVA',
            'total' => 'Total'
        ];
    }

  /**
     * Notificacion
     */

      public function notificacion_cargar($evento)
     {
        
        //Ids de los usuarios con el rol "proyecto_pedido"
        $usuarios = \Yii::$app->authManager->getUserIdsByRole('accion_centralizada_requerimiento');
        $usuarios=AccionCentralizadaAsignar::find()
        ->innerjoin('accion_centralizada_ac_especifica_uej')
        ->where(['accion_centralizada_ac_especifica_uej.id_ac_esp' => $this->asignado0->accion_centralizada_ac_especifica_uej->id_ac_esp])
        ->andWhere(['usuario' => $usuarios])
        ->all();
        foreach ($usuarios as $key => $usuario) {
            Notificaciones::notify(Notificaciones::KEY_NUEVO_PEDIDO_ACC, $usuario, $this->id);
        }
        
     }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignado0()
    {
        return $this->hasOne(AccionCentralizadaAsignar::className(), ['id' => 'asignado']);
    }

    /**
     * @return string
     */
    public function getNombreUsuario()
    {
        return $this->asignado0->usuario0->username;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMaterial()
    {
        return $this->hasOne(MaterialesServicios::className(), ['id' => 'id_material']);
    }

    /**
     * @return string
     */
    public function getNombreMaterial()
    {
        if($this->idMaterial == null)
        {
            return null;
        }

        return $this->idMaterial->nombre;
    }

    /**
     * @return string
     */
    public function getTrimestre1()
    {
        return ($this->enero+$this->febrero+$this->marzo);
    }

    /**
     * @return string
     */
    public function getTrimestre2()
    {
        return ($this->abril+$this->mayo+$this->junio);
    }

    /**
     * @return string
     */
    public function getTrimestre3()
    {
        return ($this->julio+$this->agosto+$this->septiembre);
    }

    /**
     * @return string
     */
    public function getTrimestre4()
    {
        return ($this->octubre+$this->noviembre+$this->diciembre);
    }

    /**
     * @return integer
     */
    public function getTotalTrimestre()
    {
        return (
            $this->trimestre1 +
            $this->trimestre2 +
            $this->trimestre3 +
            $this->trimestre4
        );
    }

    /**
     * @return integer
     */
    public function getSubTotal()
    {
        return ($this->totalTrimestre * $this->precio);
    }

    /**
     * @return integer
     */
    public function getIvaTotal()
    {
        return ($this->subTotal / 100 * $this->iva);
    }

    /** 
     * @return string
     */
    public function getTotal()
    {
        return \Yii::$app->formatter->asCurrency(($this->subTotal + $this->ivaTotal));
    }

    /**
     * @return string
     */
    public function getNombreEstatus()
    {
        if($this->estatus == 1)
        {
            return 'Activo';
        }

        return 'Inactivo';
    }

    public function getPrecioBolivar()
    {
        if($this->precio == null)
        {
            return null;
        }

        return \Yii::$app->formatter->asCurrency($this->precio);
    }

    /**
     * Colocar estatus en 0 "Inactivo"
     */
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

    /*
    *@active model $insert
    *formato de la fecha
    */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->fecha_creacion = date('Y-m-d H:i:s');
            return true;
        } else {
            return false;
        }
    }


     public function toggleAprobado()
     {
        if($this->aprobado == 1)
        {
            $this->aprobado = 0;
        }
        else
        {
            $this->aprobado = 1;
        }
        
        $this->save();
        
        return true;
    }

    /**
    *Obtener el total pedido por ue
    */
    public function Totalunidad($ue, $accion)
    {
        $sql="
            select 
                format(sum(round((((c.enero+c.febrero+c.marzo+c.abril+c.mayo+c.junio+c.julio+c.agosto+c.septiembre+c.octubre+c.noviembre+c.diciembre) * c.precio) * c.iva)/100)
                +
                ((c.enero+c.febrero+c.marzo+c.abril+c.mayo+c.junio+c.julio+c.agosto+c.septiembre+c.octubre+c.noviembre+c.diciembre) * c.precio))
                , 2, 'de_DE')
                as total
                from
                accion_centralizada_accion_especifica as a 
                inner join accion_centralizada_ac_especifica_uej b on a.id=b.id_ac_esp
                inner join accion_centralizada_asignar d on  b.id=d.accion_especifica_ue
                inner join accion_centralizada_pedido c on d.id=c.asignado
                where a.id=".$accion." and b.id_ue=".$ue;

        //print_r($sql); exit();
        $query = Yii::$app->db->createCommand($sql)->queryAll();
        if(isset($query[0]['total']))
        {
            return ($query[0]['total']);     
        }
        else
        {
            return 0;
        }
        
    }
    



}
