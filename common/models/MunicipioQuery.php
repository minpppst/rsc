<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Municipio]].
 *
 * @see Municipio
 */
class MunicipioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Municipio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Municipio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}