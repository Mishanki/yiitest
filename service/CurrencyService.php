<?php

namespace app\service;

use app\models\Currency;
use yii\db\Exception;
use function GuzzleHttp\Psr7\str;

class CurrencyService {

    private $host = 'http://www.cbr.ru/scripts/XML_daily.asp';

    public function get($date)
    {
        $xml = $this->getXml($date);
        $xmlDate = end($xml->attributes()->Date);

        if(Currency::find()->where([
            'date' => date('Y-m-d', strtotime($xmlDate))
        ])->count()) {
           return true;
        }

        foreach ($xml->Valute as $item) {
            $currency = new Currency();
            $currency->setAttributes([
                'code' => end($item->CharCode),
                'name' => end($item->Name),
                'value' => (int) end($item->Value),
                'date' => date('Y-m-d', strtotime($xmlDate)),
            ]);

            $currency->validate();
            if ($currency->hasErrors()) {
                throw new Exception($currency->getFirstError());
            }

            $currency->save();
        }
    }

    public function getByPeriod(string $date)
    {
        while (strtotime($date) <= strtotime(date('Y-m-d'))) {
            $this->get($date);

            $d = new \DateTime($date);
            $d->modify('+1 day');
            $date = $d->format('Y-m-d');
        }
    }

    private function getXml($date)
    {
        return simplexml_load_file($this->host.'?'.http_build_query([
                'date_req' => date('d/m/Y', strtotime($date)),
            ]));
    }
}