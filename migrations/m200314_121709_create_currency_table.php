<?php

use app\service\CurrencyService;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency}}`.
 */
class m200314_121709_create_currency_table extends Migration
{

    /** @var CurrencyService $currencyService */
    public $currencyService;

    public function __construct($config = [])
    {
        parent::__construct($config);
        /** @var CurrencyService $currencyService */
        $this->currencyService = \Yii::$container->get('currencyService');
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(255),
            'name' => $this->string(255),
            'value' => $this->integer()->notNull(),
            'date' => $this->date(),
        ]);

        $this->currencyService->getByPeriod(date('Y-m-d', strtotime('-1 month')));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%currency}}');
    }
}
