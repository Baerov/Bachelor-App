<?php

namespace backend\search;

use backend\models\Internment;
use backend\models\DictionaryDetail;
use backend\models\InterestPointXPatient;
use backend\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Patient;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * PatientSearch represents the model behind the search form about `backend\models\Patient`.
 */
class PatientSearch extends Patient
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'SectionId', 'CityId', 'Address', 'Phone', 'MobilePhone', 'Email', 'Information', 'CategoryId', 'StatusId', 'interestPoint'], 'safe'],
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
    public function search($params, $withInternment = false)
    {
        $query = Patient::find();
        // add conditions that should always apply here
        $model = User::findOne(Yii::$app->user->getId());
        if ($model->type_id !== DictionaryDetail::ADMIN) {
            $query->andWhere(['in', 'SectionId', ArrayHelper::getColumn($model->getUserXSections()->all(), 'SectionId')]);
        }
        if($withInternment){
            $query->andWhere(['not in', 'Id', ArrayHelper::getColumn(Internment::find()->all(), 'PatientId')]);
        }
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
            'Id' => $this->Id,
            'CityId' => $this->CityId,
            'SectionId' => $this->SectionId,
        ]);
        
        if(!empty($this->interestPoint)){
            // filter by interestPoints
            $query->andWhere(['interestPoint' => $this->interestPoint]);
            $query->joinWith(['interestPointXPatients'])->where(['InterestPointId' => $this->interestPoint]);
        }

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'Address', $this->Address])
            ->andFilterWhere(['like', 'Phone', $this->Phone])
            ->andFilterWhere(['like', 'MobilePhone', $this->MobilePhone])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'Information', $this->Information])
            ->andFilterWhere(['like', 'CategoryId', $this->CategoryId]);

        $query->andWhere(['Patient.Enabled' => 1]);
        return $dataProvider;
    }
}
