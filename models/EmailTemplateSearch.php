<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EmailTemplate;

/**
 * EmailTemplateSearch represents the model behind the search form about `app\models\EmailTemplate`.
 */
class EmailTemplateSearch extends EmailTemplate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'modified_by'], 'integer'],
            [['template_name', 'subject', 'body', 'attachments', 'created_date', 'modified_date'], 'safe'],
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
        $query = EmailTemplate::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
            'modified_date' => $this->modified_date,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'template_name', $this->template_name])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'attachments', $this->attachments]);

        return $dataProvider;
    }
}
