<?php

namespace app\models\filters;

use yii\base\Model;

/**
 * @property string $dateRange
 * @property string $dateStart
 * @property string $dateEnd
 */
class DateRangeFilter extends Model
{
    public $dateRange;
    public $dateStart;
    public $dateEnd;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['dateRange', 'dateStart', 'dateEnd'], 'safe'],
        ];
    }
}
