<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Account info';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-info">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please, fill out the following fields:</p>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])
        ->hint('Please,enter your account name')->label('Account name') ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true])
        ->hint('Please,enter your current state of amount.For empty account enter 0.')->label('Amount') ?>

    <?= $form->field($model, 'currency')->dropDownList(['RUB'=>'RUB', 'EUR'=>'EUR','USD'=>'USD','UAH'=>'UAH']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
