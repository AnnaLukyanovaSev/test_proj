<?php
/* @var $this yii\web\View */
/* @var $model common\models\Category */

/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use gudezi\fancytree\FancytreeWidget;

$this->title = 'Create transaction';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="transaction-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please, fill out the following fields:</p>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'amount')->textInput(['type' => 'number'])->label('Amount') ?>

    <?= $form->field($model, 'account_id')
        ->dropDownList(ArrayHelper::map(common\models\Account::find()
            ->where(['user_id' => Yii::$app->user->identity->getId()])
            ->all(), 'id', 'name'))->label('Account name') ?>

    <?= $form->field($model, 'currency')->
    dropDownList(ArrayHelper::map(common\models\Account::find()->all(), 'currency', 'currency')) ?>


    <?=$form->field($model, 'sub')->widget(FancytreeWidget::classname(), [
        'name' => 'fancytree',
        'source' => common\models\Category::findOne(['name' => 'Expense'])->tree(),
        'clickFolderMode' => FancytreeWidget::CLICK_ACTIVATE_EXPAND,
        'options' => [
        ],
    ])->label('Category of transaction')
    ?>
    <?= $form->field($model, 'date')->textInput(['type' => 'date', 'value' => date('Y-m-d')]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
