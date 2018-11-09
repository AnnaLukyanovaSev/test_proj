<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\forms\ProfileForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Profile info';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-info">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to be a fully valid user:</p>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true])
        ->hint('Please,enter your first name')->label('Name') ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true])
        ->hint('Please,enter your last name')->label('Surname') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
