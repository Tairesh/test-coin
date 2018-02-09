<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ExchangeForm is the model behind the exchange form.
 * @var string $date
 */
class ExchangeForm extends Model
{

    public $amount;
    protected $dateText;
    protected $dateTime;
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
	    // TODO: optimization
	    $startData = Yii::$app->coinapi->GetExchangeRate('BTC', 'USD', $this->dateTime);
	    $currentData = Yii::$app->coinapi->GetExchangeRate('BTC', 'USD');

	    $startCost = $startData->rate * $this->amount;
	    $currentCost = $currentData->rate * $this->amount;

	    $this->profitUSD = $currentCost - $startCost;
	    $this->profitPercent = 100 * $this->profitUSD / $startCost;
	    return true;
	}
	return false;
    }

    public function setDate($text)
    {
	$this->dateText = $text;
	$this->dateTime = new \DateTime();
	$this->dateTime->setTimestamp(strtotime($text));
    }

    public function getDate()
    {
	return $this->dateText;
    }

}
