<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AcEspUej;

/**
 * AcEspUejSearch represents the model behind the search form about `app\models\AcEspUej`.
 */
class AcEspUejSearch extends AcEspUej
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_ue', 'id_ac_esp'], 'integer'],
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
        $query = AcEspUej::find();

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
            'id_ue' => $this->id_ue,
            'id_ac_esp' => $this->id_ac_esp,
        ]);

        return $dataProvider;
    }
}
