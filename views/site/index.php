<?php

use \yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider \app\models\CurrencySearch */

$this->title = 'МЧС';
?>
<div class="site-index">

    <h1>Currency</h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'code',
            'name',
            'value',
            'date',
        ],
    ]); ?>

</div>
