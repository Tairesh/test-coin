<?php

namespace app\components;

use Yii;
use yii\base\Component;

/**
 * Description of RateCache
 *
 * @author ilya
 */
class RateCache extends Component
{

    public function getRate($dateText)
    {
	/* @var $cursor \MongoDB\Driver\Cursor */
	$cursor = Yii::$app->db->createCommand(['date' => $dateText])->query('rates');
	$data = null;
	foreach ($cursor as $row) {
	    $data = (object) $row;
	    break;
	}
	if (!$data) {
	    $dateTime = new \DateTime();
	    $dateTime->setTimestamp(strtotime($dateText));
	    $data = Yii::$app->coinapi->getExchangeRate('BTC', 'USD', $dateTime);
	    $this->setRate($dateText, $data->rate);
	}
	return $data->rate;
    }

    public function setRate($dateText, $rate)
    {
	/* @var $command yii\mongodb\Command */
	$command = Yii::$app->db->createCommand();
	$command->insert('rates', ['date' => $dateText, 'rate' => $rate]);
    }

}
