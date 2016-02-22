<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MaterialesServicios;

/**
 * MaterialesServiciosSearch represents the model behind the search form about `app\models\MaterialesServicios`.
 */
class MaterialesServiciosSearch extends MaterialesServicios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_se', 'unidad_medida', 'presentacion', 'iva', 'estatus'], 'integer'],
            [['nombre'], 'safe'],
            [['precio'], 'number'],
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
        $query = MaterialesServicios::find();

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
            'id_se' => $this->id_se,
            'unidad_medida' => $this->unidad_medida,
            'presentacion' => $this->presentacion,
            'precio' => $this->precio,
            'iva' => $this->iva,
            'estatus' => $this->estatus,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
