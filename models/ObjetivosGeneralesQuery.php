<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ObjetivosGenerales]].
 *
 * @see ObjetivosGenerales
 */
class ObjetivosGeneralesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ObjetivosGenerales[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ObjetivosGenerales|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}