<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Account */

$this->title = 'Update Account: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="account-update">

    <h1><?= Html::encode($this->title) ?></h1>

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
