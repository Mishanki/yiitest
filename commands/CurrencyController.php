<?php

namespace app\commands;

use app\service\CurrencyService;
use yii\console\Controller;

class CurrencyController extends Controller
{
    /** @var CurrencyService $currencyService */
    public $currencyService;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        /** @var CurrencyService $currencyService */
        $this->currencyService = \Yii::$container->get('currencyService');
    }

    public function actionIndex($date)
    {
        $this->currencyService->getByPeriod($date);
    }
}

