<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProyectoVariables;

/**
 * ProyectoVariablesSearch represents the model behind the search form about `backend\models\ProyectoVariables`.
 */
class ProyectoVariablesSearch extends ProyectoVariables
{
    public $nombreProyecto;
    public $codigoProyecto;
    public $nombreAccion;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'unidad_medida', 'localizacion', 'unidad_ejecutora', 'accion_especifica', 'impacto'], 'integer'],
            [['nombre_variable', 'definicion', 'base_calculo', 'fuente_informacion', 'fecha_creacion', 'fecha_modificacion', 'fecha_eliminacion', 'nombreProyecto', 'nombreAccion', 'codigoProyecto'], 'safe'],
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
        $query = ProyectoVariables::find();

        $query->joinWith(['accionEspecifica']);
        $query->joinWith(['accionEspecifica.idProyecto']);
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
            'unidad_medida' => $this->unidad_medida,
            'localizacion' => $this->localizacion,
            'unidad_ejecutora' => $this->unidad_ejecutora,
            'accion_especifica' => $this->accion_especifica,
            'impacto' => $this->impacto,
            'fecha_creacion' => $this->fecha_creacion,
            'fecha_modificacion' => $this->fecha_modificacion,
            'fecha_eliminacion' => $this->fecha_eliminacion,
        ]);

        $query->andFilterWhere(['like', 'nombre_variable', $this->nombre_variable])
            ->andFilterWhere(['like', 'proyecto.nombre', $this->nombreProyecto])
            ->andFilterWhere(['like', 'proyecto.codigo_proyecto', $this->codigoProyecto])
            ->andFilterWhere(['like', 'proyecto_accion_especifica.nombre', $this->nombreAccion]);

        return $dataProvider;
    }
}
