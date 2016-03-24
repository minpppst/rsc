<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProyectoAccionEspecifica]].
 *
 * @see ProyectoAccionEspecifica
 */
class ProyectoAccionEspecificaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProyectoAccionEspecifica[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProyectoAccionEspecifica|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}