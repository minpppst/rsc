<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AcAcEspec;

/**
 * AcAcEspecSearch represents the model behind the search form about `app\models\AcAcEspec`.
 */
class AcAcEspecSearch extends AcAcEspec
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_ac_centr'], 'integer'],
            [['cod_ac_espe', 'nombre'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AcAcEspec::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_ac_centr' => $this->id_ac_centr,
        ]);

        $query->andFilterWhere(['like', 'cod_ac_espe', $this->cod_ac_espe])
            ->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
