<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProyectoRegistrador]].
 *
 * @see ProyectoRegistrador
 */
class ProyectoRegistradorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProyectoRegistrador[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProyectoRegistrador|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}