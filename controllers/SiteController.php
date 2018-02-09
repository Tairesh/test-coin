<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ExchangeForm;

class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
	return [
	    'error' => [
		'class' => 'yii\web\ErrorAction',
	    ],
	];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
	$model = new ExchangeForm();
	if ($model->load(Yii::$app->request->post()) && $model->calculate()) {
	    Yii::$app->session->setFlash('exchangeFormSubmitted');

	    return $this->refresh();
	}
	return $this->render('form', [
		    'model' => $model,
	]);
    }

}
