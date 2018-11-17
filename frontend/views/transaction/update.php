<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use gudezi\fancytree\FancytreeWidget;

/* @var $this yii\web\View */
/* @var $model common\models\Account */

$this->title = 'Update Transaction: ';
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'transaction', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transaction-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'amount')->textInput(['type' => 'number'])->label('Amount') ?>

    <?= $form->field($model, 'account_id')
        ->dropDownList(ArrayHelper::map(common\models\Account::find()
            ->where(['user_id' => Yii::$app->user->identity->getId()])
            ->all(), 'id', 'name'))->label('Account name') ?>

    <?= $form->field($model, 'currency')->dropDownList([
        'RUB' => 'RUB',
        'EUR' => 'EUR',
        'USD' => 'USD',
        'UAH' => 'UAH'
    ]) ?>

    <?=$form->field($model, 'sub')->widget(FancytreeWidget::classname(), [
        'name' => 'fancytree',
        'source' => common\models\Category::findOne(['name' => 'Expense'])->tree(),
        'clickFolderMode' => FancytreeWidget::CLICK_ACTIVATE_EXPAND,
        'options' => [
        ],
    ])->label('Category of transaction')
    ?>

    <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
