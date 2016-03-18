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
    public $codigoSubEspecifica;
    public $nombrePresentacion;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_se', 'unidad_medida', 'presentacion', 'iva', 'estatus'], 'integer'],
            [['nombre', 'codigoSubEspecifica', 'nombrePresentacion'], 'safe'],
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
        // Join para la relacion
        $query->joinWith(['idSe']);
        $query->joinWith(['presentacion0']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //Ordenamiento
        $dataProvider->sort->attributes['codigoSubEspecifica'] = [
            'asc' => ['partida_sub_especfica.sub_especfica' => SORT_ASC],
            'desc' => ['partida_sub_especfica.sub_especfica' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['nombrePresentacion'] = [
            'asc' => ['presentacion.nombre' => SORT_ASC],
            'desc' => ['presentacion.nombre' => SORT_DESC],
        ];

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
        $query->andFilterWhere(['partida_sub_especfica.sub_especfica' => $this->id_se]);
        $query->andFilterWhere(['like', 'presentacion.nombre', $this->nombrePresentacion]);

        return $dataProvider;
    }
}
