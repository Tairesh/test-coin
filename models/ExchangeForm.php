<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ExchangeForm is the model behind the exchange form.
 */
class ExchangeForm extends Model
{

    public $amount;
    public $date;
    public $profitUSD;
    public $profitPercent;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
	return [
	    [['amount', 'date'], 'required'],
	    ['amount', 'number'],
	];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
	return [
	    'date' => 'Дата покупки',
	    'amount' => 'Количество BTC',
	];
    }

    /**
     *
     */
    public function calculate()
    {
	if ($this->validate()) {
	    // check in cache
	    $startRate = Yii::$app->ratecache->getRate($this->date);
	    $currentRate = Yii::$app->ratecache->getRate(date('d-m-Y'));

	    $this->profitUSD = ($currentRate - $startRate) * $this->amount;
	    $this->profitPercent = 100 * $this->profitUSD / ($startRate * $this->amount);
	    return true;
	}
	return false;
    }

}
