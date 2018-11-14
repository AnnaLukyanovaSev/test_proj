<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $model common\models\Transaction */
/* @var $this yii\web\View */
/* @var $searchModel common\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'header' => '№',],
            ['label' => 'Money amount',
                'attribute' => 'amount',
            ],
            'currency',
            'date',
            ['label' => 'Account',
                'attribute' => 'account.name',
            ],
            ['label' => 'Category',
                'attribute' => 'category.name',
            ],
           // 'category.name',
            [
                'class' => 'yii\grid\ActionColumn',
            ],
        ],
    ]); ?>
</div>
