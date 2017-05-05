<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UnidadMedidaProductos;

/**
 * UnidadMedidaProductosSearch represents the model behind the search form about `common\models\UnidadMedidaProductos`.
 */
class UnidadMedidaProductosSearch extends UnidadMedidaProductos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipo', 'estatus'], 'integer'],
            [['unidad_medida'], 'safe'],
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
        $query = UnidadMedidaProductos::find();

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
            'tipo' => $this->tipo,
            'estatus' => $this->estatus,
        ]);

        $query->andFilterWhere(['like', 'unidad_medida', $this->unidad_medida]);

        return $dataProvider;
    }
}
