<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Transaction';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>Your account information</p>

<ul>
    <li><label>Amount</label>: <?= Html::encode($model->amount), Html::encode(' '), Html::encode($model->currency) ?>
    <li><label>Name</label>: <?= Html::encode($model->created_at) ?></li>
    <li><label>Name</label>: <?= Html::encode($model->date) ?></li>
</li></ul>
<p>
    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        </p>
