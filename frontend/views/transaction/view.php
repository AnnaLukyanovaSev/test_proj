<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Transaction';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>Your transaction information</p>

<ul>
    <li><label>Amount</label>: <?= Html::encode($model->amount), Html::encode(' '), Html::encode($model->currency) ?>
    <li><label>Created at UTC time</label>: <?= Html::encode(date('d-M-Y H:i:s',$model->created_at)) ?></li>
    <li><label>Date of transaction</label>: <?= Html::encode($model->date) ?></li>
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
