<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Account';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>Your account information</p>

<ul>

    <li><label>Amount</label>: <?= Html::encode($model->amount), Html::encode(' '), Html::encode($model->currency) ?>
    </li>
    <li><label>Created at UTC time</label>: <?= Html::encode(date('d-M-Y H:i:s',$model->created_at)) ?>
</li></ul>
<p>
    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('My accounts', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        </p>
