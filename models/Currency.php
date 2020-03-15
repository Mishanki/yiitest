<?php

namespace app\models;

use yii\db\ActiveRecord;

class Currency extends ActiveRecord
{
    public function rules()
    {
        return [
            [['value'], 'integer'],
            [['name', 'date', 'code'], 'string'],
        ];
    }

    public static function tableName()
    {
        return 'currency';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'value' => 'Value',
            'date' => 'Update date',
        ];
    }
}
