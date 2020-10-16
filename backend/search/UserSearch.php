<?php

namespace backend\search;

use backend\models\Dictionary;
use backend\models\DictionaryDetail;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\User;
use yii\helpers\ArrayHelper;

/**
 * UserSearch represents the model behind the search form about `backend\models\User`.
 */
class UserSearch extends User
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'type_id', 'section', 'email', 'Enabled'], 'safe'],
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
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
            'status' => $this->status,
        ]);
        if(!empty($this->section)){
            // filter by sections
            $query->andWhere(['section' => $this->section]);
            $query->joinWith(['userXSections'])->where(['SectionId' => $this->section]);
        }



        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'type_id', $this->type_id]);

        $query->andWhere(['user.Enabled' => 1]);
        return $dataProvider;
    }
}