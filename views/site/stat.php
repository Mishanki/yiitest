<?php

use \kartik\form\ActiveForm;
use \kartik\daterange\DateRangePicker;
use \miloschuman\highcharts\Highcharts;
use \yii\helpers\Html;
use \app\models\filters\DateRangeFilter;

/** @var array $filter */
/** @var array $categories */
/** @var array $series */
?>

<label class="control-label">Date Range</label>
<div class="input-group drp-container">
    <?php $form = ActiveForm::begin(); ?>

    <div style="float: left; width: 200px; margin-right: 0px">
        <?= DateRangePicker::widget([
            'model'=> DateRangeFilter::class,
            'name'=>'datePicker',
            'attribute'=>'date',
            'startAttribute' => 'dateStart',
            'endAttribute' => 'dateEnd',
            'value' => $filter['dateStart'] . ' - ' . $filter['dateEnd'],
            'convertFormat'=>true,
            'pluginOptions'=>[
                'timePicker'=>false,
                'locale'=>[
                    'format'=>'Y-m-d'
                ]
            ]
        ]); ?>
    </div>

    <?= Html::submitButton("Search" , ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>

</div>

<?= Highcharts::widget([
    'options' => [
        'title' => ['text' => 'Currency'],
        'xAxis' => [
            'categories' => $categories,
        ],
        'yAxis' => [
            'title' => ['text' => 'Value']
        ],
        'series' => $series,
    ]
]);
?>