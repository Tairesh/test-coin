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
    protected $dateUnix;
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
	    // TODO: logic
	    $this->profitPercent = 123;
	    $this->profitUSD = 321;
	    return true;
	}
	return false;
    }

    public function setDate($text)
    {
	$this->dateText = $text;
	$this->dateUnix = strtotime($text);
    }

    public function getDate()
    {
	return $this->dateText;
    }

}
