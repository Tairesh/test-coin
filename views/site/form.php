<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ExchangeForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use yii\bootstrap\Alert;

$this->title = 'Profit Calculator';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
	<div class="col-lg-5">

	    <?php $form = ActiveForm::begin(['id' => 'exchange-form']); ?>

	    <?= $form->field($model, 'amount')->textInput(['autofocus' => true]) ?>

	    <?=
	    $form->field($model, 'date')->widget(DatePicker::className(), [
		'options' => ['placeholder' => 'Выберите дату...'],
		'pluginOptions' => [
		    'format' => 'dd-mm-yyyy',
		    'todayHighlight' => true,
		    'autoclose' => true,
		]
	    ])

	    ?>

	    <div class="form-group">
		<?= Html::submitButton('Посчитать', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	    <?php if (Yii::$app->session->hasFlash('exchangeFormSubmitted')): ?>
		<?=
		Alert::widget([
		    'body' => '<h3>' . ($model->profitUSD > 0 ? 'Ваша прибыль' : 'Ваш убыток') .
		    ' составляет $' . number_format(abs($model->profitUSD), 2, '.', '&nbsp;') .
		    ' (' . number_format(abs($model->profitPercent), 2, '.', '&nbsp;') . '%)' .
		    '</h3>',
		    'closeButton' => [],
		    'options' => [
			'class' => $model->profitUSD > 0 ? 'alert-success' : 'alert-danger',
		    ],
		])

		?>
	    <?php endif ?>
	</div>
    </div>
</div>
