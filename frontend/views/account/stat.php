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
        <p>Here you can see user statistics for account currencies</p>
        <p>Ruble accounts:<?= Html::encode($model['RUB']/$model['ALL']*100)?>%</p>
        <p>Dollar accounts:<?= Html::encode($model['USD']/$model['ALL']*100)?>%</p>
        <p>Euro accounts:<?= Html::encode($model['EUR']/$model['ALL']*100)?>%</p>
        <p>Grivna accounts:<?= Html::encode($model['UAH']/$model['ALL']*100)?>%</p>
    </b>

    <table border="1" align="center" >
        <caption></caption>
        <tr>
            <th>Currency</th>
            <th>Percentage</th>
        </tr>
        <tr><td>Ruble</td><td><?= Html::encode($model['RUB']/$model['ALL']*100)?></td></tr>
        <tr><td>Dollar</td><td><?= Html::encode($model['USD']/$model['ALL']*100)?></td></tr>
        <tr><td>Euro</td><td><?= Html::encode($model['EUR']/$model['ALL']*100)?></td></tr>
        <tr><td>Grivna </td><td><?= Html::encode($model['UAH']/$model['ALL']*100)?></td></tr>

    </table>
</div>
