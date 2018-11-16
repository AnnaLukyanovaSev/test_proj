<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Category';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>Your category information</p>

<ul>
    <li><label>Name</label>: <?= Html::encode($model->name) ?></li>

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
