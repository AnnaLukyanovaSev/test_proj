<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Transaction', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'amount',
            'user_id',
            'currency',
            'account_id',
            //'category_id',
            //'family_id',
            //'created_at',
            //'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
