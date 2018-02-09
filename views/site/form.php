<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Profit Calculator';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
	<div class="col-lg-5">

	    <?php $form = ActiveForm::begin(['id' => 'exchange-form']); ?>

	    <?= $form->field($model, 'amount')->textInput(['autofocus' => true]) ?>

	    <?= $form->field($model, 'date') ?>

	    <div class="form-group">
		<?= Html::submitButton('Посчитать', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>
    </div>
</div>
