<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MaterialesServicios;

/**
 * MaterialesServiciosSearch represents the model behind the search form about `app\models\MaterialesServicios`.
 */
class MaterialesServiciosSearch extends MaterialesServicios
{
    public $nombreUnidadMedida;
    public $nombrePresentacion;    
    public $nombreEstatus;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cuenta', 'partida', 'generica', 'especifica', 'subespecifica', 'unidad_medida', 'presentacion', 'iva', 'estatus'], 'integer'],
            [['nombre', 'nombrePresentacion', 'nombreUnidadMedida', 'nombreEstatus'], 'safe'],
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
        //$query->joinWith(['cuenta0']);
        $query->joinWith(['presentacion0']);
        $query->joinWith(['unidadMedida']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //Ordenamiento
        $dataProvider->sort->attributes['nombrePresentacion'] = [
            'asc' => ['presentacion.nombre' => SORT_ASC],
            'desc' => ['presentacion.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['nombreUnidadMedida'] = [
            'asc' => ['unidad_medida.unidad_medida' => SORT_ASC],
            'desc' => ['unidad_medida.unidad_medida' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'cuenta' => $this->cuenta,
            'partida' => $this->partida,
            'generica' => $this->generica,
            'especifica' => $this->especifica,
            'subespecifica' => $this->subespecifica,
            'unidad_medida' => $this->unidad_medida,
            'presentacion' => $this->presentacion,
            'precio' => $this->precio,
            'iva' => $this->iva,
            'materiales_servicios.estatus' => $this->estatus,
        ]);

        $query->andFilterWhere(['materiales_servicios.estatus' => $this->nombreEstatus]);
        $query->andFilterWhere(['like', 'materiales_servicios.nombre', $this->nombre]);
        $query->andFilterWhere(['like', 'presentacion.nombre', $this->nombrePresentacion]);
        $query->andFilterWhere(['like', 'unidad_medida.unidad_medida', $this->nombreUnidadMedida]);

        return $dataProvider;
    }
}
