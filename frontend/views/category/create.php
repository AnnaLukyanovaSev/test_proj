<?php
/* @var $this yii\web\View */
/* @var $model common\models\Category */

/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Create category';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="category-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please, fill out the following fields:</p>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])
        ->hint('Enter category name')->label('Category name') ?>

    <?= $form->field($model, 'sub')
        ->dropDownList(ArrayHelper::map(common\models\Category::find()->all(),'id','name'))
        ->label('Parent category') ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
