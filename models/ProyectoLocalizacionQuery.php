<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProyectoLocalizacion]].
 *
 * @see ProyectoLocalizacion
 */
class ProyectoLocalizacionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProyectoLocalizacion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProyectoLocalizacion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}