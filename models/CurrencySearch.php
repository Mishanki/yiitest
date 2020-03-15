<?php

namespace app\models;

use kartik\daterange\DateRangeBehavior;
use yii\data\ActiveDataProvider;

/**
 * Class CurrencySearch.
 * @property int $id [int(11)]
 * @property string $code [varchar(255)]
 * @property string $name [varchar(255)]
 * @property int $value [int(11)]
 * @property string $date [timestamp]
 */
class CurrencySearch extends Currency
{

    public $dateStart;
    public $dateEnd;

    public function rules()
    {
        return [
            [['id', 'code', 'name', 'value', 'date', 'dateStart', 'dateEnd'], 'safe'],
        ];
    }

    public function search($params = [])
    {
        $query = parent::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => ['code','date'],
                'defaultOrder' => ['date'=>SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['code' => $this->code]);
        $query->andFilterWhere(['name' => $this->name]);

        $query->andFilterWhere(['>=', 'date', $this->dateStart]);
        $query->andFilterWhere(['<=', 'date', $this->dateEnd]);

        return $dataProvider;
    }
}
