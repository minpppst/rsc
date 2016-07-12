<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AccionCentralizadaPedido;

/**
 * AccionCentralizadaPedidoSearch represents the model behind the search form about `app\models\AccionCentralizadaPedido`.
 */
class AccionCentralizadaPedidoSearch extends AccionCentralizadaPedido
{
    public $nombreMaterial;
    public $idUnidadEjecutora;
    public $idAcc;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_material', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'asignado', 'estatus'], 'integer'],
            [['precio'], 'number'],
            [['fecha_creacion', 'nombreMaterial'], 'safe'],
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
        $query = AccionCentralizadaPedido::find();
        // Join para la relacion
        $query->joinWith(['idMaterial']);
        $query->joinWith(['asignado0.accion_centralizada_ac_especifica_uej']);
        $query->joinWith(['asignado0.accion_centralizada_ac_especifica_uej']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //Ordenamiento
        $dataProvider->sort->attributes['nombreMaterial'] = [
            'asc' => ['materiales_servicios.nombre' => SORT_ASC],
            'desc' => ['materiales_servicios.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['idUnidadEjecutora'] = [
            'asc' => ['accion_centralizada_ac_especifica_uej.id_ue' => SORT_ASC],
            'desc' => ['accion_centralizada_ac_especifica_uej.id_ue' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['idAcc'] = [
            'asc' => ['accion_centralizada_ac_especifica_uej.id_ac_esp' => SORT_ASC],
            'desc' => ['accion_centralizada_ac_especifica_uej.id_ac_esp' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_material' => $this->id_material,
            'enero' => $this->enero,
            'febrero' => $this->febrero,
            'marzo' => $this->marzo,
            'abril' => $this->abril,
            'mayo' => $this->mayo,
            'junio' => $this->junio,
            'julio' => $this->julio,
            'agosto' => $this->agosto,
            'septiembre' => $this->septiembre,
            'octubre' => $this->octubre,
            'noviembre' => $this->noviembre,
            'diciembre' => $this->diciembre,
            'precio' => $this->precio,
            'fecha_creacion' => $this->fecha_creacion,
            'asignado' => $this->asignado,
            'accion_centralizada_pedido.estatus' => $this->estatus,
        ]);

        $query->andFilterWhere(['like','materiales_servicios.nombre',$this->nombreMaterial]);
        $query->andFilterWhere(['accion_centralizada_ac_especifica_uej.id_ue' => $this->idUnidadEjecutora]);
        $query->andFilterWhere(['accion_centralizada_ac_especifica_uej.id_ac_esp' => $this->idAcc]);

        return $dataProvider;
    }
}
