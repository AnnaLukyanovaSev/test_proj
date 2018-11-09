<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>Your profile information</p>

<ul>
    <li><label>Name</label>: <?= Html::encode($model->first_name) ?></li>
    <li><label>Surname</label>: <?= Html::encode($model->last_name) ?></li>
</ul>

<p><a class="btn btn-lg btn-success" href="http://fam_money.test/profile/update">Update information</a></p>


