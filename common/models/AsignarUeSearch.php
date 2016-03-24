<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AsignarUe;

/**
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 * 
 */
class AsignarUeSearch extends AsignarUe 
{
    /**
     *
     * @var mixed $id
     */
    public $id;

    /**
     *
     * @var mixed $id
     */
    public $username;

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'username'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Usuario',
        ];
    }

    /**
     * Create data provider for Assignment model.    
     */
    public function search() {
        $query = call_user_func($this->rbacModule->userModelClassName . "::find");
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $params = Yii::$app->request->getQueryParams();

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', $this->rbacModule->userModelIdField, $this->login]);

        return $dataProvider;
    }

}
