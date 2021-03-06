<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $model common\models\Account */
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'amount',
            'currency',
            'name',
            [
                'class' => 'yii\grid\ActionColumn',
            ],
        ],
    ]); ?>
</div>
