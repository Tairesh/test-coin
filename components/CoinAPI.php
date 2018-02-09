<?php

namespace app\components;

use yii\base\Component;

class CoinAPI extends Component
{

    public $ApiKey;

    // Exchange Rates
    function getExchangeRate($asset_id_base, $asset_id_qoute, $time = null)
    {
	if ($asset_id_base == null) {
	    throw new \InvalidArgumentException("asset_id_base is required");
	}
	if ($asset_id_qoute == null) {
	    throw new \InvalidArgumentException("asset_id_qoute is required");
	}
	if ($time != null) {
	    $time = $this->formatDateTime($time);
	    $url = 'https://rest.coinapi.io/v1/exchangerate/' . $asset_id_base . '/' . $asset_id_qoute . '?time=' . $time;
	} else {
	    $url = 'https://rest.coinapi.io/v1/exchangerate/' . $asset_id_base . '/' . $asset_id_qoute;
	}
	return $this->curlRequest($url);
    }

    //Formate DateTime Object
    protected function formatDateTime($DateTimeObj)
    {
	$timestring = $DateTimeObj->format('Y-m-d H:i:s.u');
	$timestring = str_replace(' ', 'T', $timestring);
	return $timestring . '0Z';
    }

    //Curl Request
    protected function curlRequest($url)
    {
	$ch = \curl_init($url);

	\curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	    'X-CoinAPI-Key: ' . $this->ApiKey,
	    'Content-Type: application/json'
	));
	\curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$output = \curl_exec($ch);
	$info = \curl_getinfo($ch);
	if ($output === false) {
	    if (\curl_error($ch)) {
		throw new \Exception(curl_error($ch));
	    } else {
		throw new \Exception($info);
	    }
	}
	$json_data = json_decode($output);
	if ($json_data == NULL) {
	    // json parsing failed
	    throw new \Exception($output);
	}
	$http_status_code = \curl_getinfo($ch, CURLINFO_HTTP_CODE);
	if ($http_status_code != 200) {
	    throw new \Exception(print_r($json_data, 1));
	}
	\curl_close($ch);
	return $json_data;
    }

}

?>