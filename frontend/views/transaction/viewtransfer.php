<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Transfer between accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>Your transfer information</p>

<ul>
    <li><label>Amount</label>: <?= Html::encode($model->amount), Html::encode(' '), Html::encode($model->currency) ?>
    <li><label>Created at</label>: <?= Html::encode(date('d-M-Y H:i:s', $model->created_at)) ?></li>
    <li><label>Date of transfer</label>: <?= Html::encode($model->date) ?></li>
    <li><label>Transferred to account</label>: <?= Html::encode(common\models\Account::find()->select('name')
            ->where(['id' => $model->account_id])->scalar()) ?></li>
    <li><label>Transferred from account</label>: <?= Html::encode(
            common\models\Account::find()->select('name')
                ->where([
                    'id' => \common\models\Transaction::find()->select('account_id')->where([
                        '>',
                        'created_at',
                        -1 + $model->created_at
                    ])
                        ->andWhere(['<', 'created_at', 3 + $model->created_at])
                        ->andWhere(['!=', 'id', $model->id])->scalar()
                ])->scalar()) ?></li>
    </li></ul>
<p>
    <?= Html::a('Update', ['updatetransfer', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['deletetransfer', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
</p>
