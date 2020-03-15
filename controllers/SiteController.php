<?php

namespace app\controllers;

use app\models\CurrencySearch;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;

        $searchModel = new CurrencySearch();
        $searchModel->setAttributes([]);
        $dataProvider = $searchModel->search($request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionStat()
    {
        $filter = $this->getFilter(Yii::$app->request);

        $searchModel = new CurrencySearch();
        $searchModel->setAttributes($filter);
        $dataProvider = $searchModel->search();

        $data = $this->getGraph($dataProvider);

        return $this->render('stat', [
            'categories' => $data['categories'],
            'series' => $data['series'],
            'filter' => $filter,
        ]);
    }

    private function getFilter($request)
    {
        if (!empty($request->bodyParams['dateStart'])) {
            $params = $request->bodyParams;
        } else {
            $params = [
                'dateStart' => date('Y-m-d', strtotime('-14 day')),
                'dateEnd' => date('Y-m-d'),
            ];
        }

        return $params;
    }

    private function getGraph($dataProvider) {

        $series = [];
        $categories = [];
        $data = [];
        foreach ($dataProvider->query->all() as $model) {
            if (!in_array($model->code, ['USD', 'EUR', 'JPY'])) {
                continue;
            }
            $data[$model->code][] = $model->value;
            $categories[] = $model->date;
        }

        $categories = array_values(array_unique($categories));

        foreach ($data as $code => $value) {
            $series[] = [
                'name' => $code,
                'data' => $value,
            ];
        }

        return ['categories' => $categories, 'series' => $series];
    }
}
