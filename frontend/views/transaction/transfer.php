<?php
/* @var $this yii\web\View */
/* @var $model common\models\Category */

/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Create transfer';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="transaction-create-transfer">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please, fill out the following fields:</p>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'amount')->textInput(['type' => 'number'])->label('Amount') ?>

    <?= $form->field($model, 'receiver')
        ->dropDownList(ArrayHelper::map(common\models\Account::find()
            ->where(['user_id' => Yii::$app->user->identity->getId()])
            ->asArray()->all(), 'id', 'name'),
            [
                'prompt' => 'Choose your account',
                'onchange' => '
    $.post( "' . Yii::$app->urlManager->createUrl('account/listing?id=') . '"+$(this).val(), function( data ) {
    $( "select#x" ).html( data );
    });
     $.post( "' . Yii::$app->urlManager->createUrl('account/lists?id=') . '"+$(this).val(), function( data ) {
    $( "select#currency" ).html( data );
    });
    '
            ])->label('From account') ?>


    <?= $form->field($model, 'account_id')
        ->dropDownList([],[
                'prompt' => '...',
                'id' => 'x'
            ])->label('To account') ?>

    <?= $form->field($model, 'currency')->dropDownList([], [
        'prompt' => '...',
        'id' => 'currency'
    ]) ?>

    <?= $form->field($model, 'category_id')
        ->dropDownList(ArrayHelper::map(common\models\Category::find()->where(['name' => 'Transfer'])
            ->all(), 'id', 'name'))->label('Transaction category') ?>

    <?= $form->field($model, 'date')->textInput(['type' => 'date', 'value' => date('Y-m-d')]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
