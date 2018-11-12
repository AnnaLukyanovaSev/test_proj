<?php

use yii\helpers\Html;

/* @var $model common\models\Account */
/* @var $this yii\web\View */
/* @var $searchModel common\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account currency statistic';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <b>
        <div>
            <p>Here you can see user statistics for account currencies:</p>
            <?php if ($model['ALL'] == 0) {
                echo 'No statistics is available now.';
                return null;
            } ?>
            <p>Ruble accounts:<?= Html::encode($model['RUB'] / $model['ALL'] * 100) ?>%</p>
            <p>Dollar accounts:<?= Html::encode($model['USD'] / $model['ALL'] * 100) ?>%</p>
            <p>Euro accounts:<?= Html::encode($model['EUR'] / $model['ALL'] * 100) ?>%</p>
            <p>Grivna accounts:<?= Html::encode($model['UAH'] / $model['ALL'] * 100) ?>%</p>
    </b>
</div>
</div>
